<?php

namespace GoDaddy\WordPress\MWC\Core\Events\Subscribers;

use Exception;
use GoDaddy\WordPress\MWC\Common\Configuration\Configuration;
use GoDaddy\WordPress\MWC\Common\Events\Contracts\EventBridgeEventContract;
use GoDaddy\WordPress\MWC\Common\Events\Contracts\EventContract;
use GoDaddy\WordPress\MWC\Common\Events\Contracts\SubscriberContract;
use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Common\Http\Response;
use GoDaddy\WordPress\MWC\Common\Models\User;
use GoDaddy\WordPress\MWC\Common\Repositories\ManagedExtensionsRepository;
use GoDaddy\WordPress\MWC\Common\Repositories\ManagedWooCommerceRepository;
use GoDaddy\WordPress\MWC\Common\Repositories\WooCommerceRepository;
use GoDaddy\WordPress\MWC\Common\Repositories\WordPress\SiteRepository;
use GoDaddy\WordPress\MWC\Common\Repositories\WordPressRepository;
use GoDaddy\WordPress\MWC\Core\Auth\ManagedWooCommerce\Exceptions\TokenCreateFailedException;
use GoDaddy\WordPress\MWC\Core\Auth\ManagedWooCommerce\Http\Providers\AuthProvider;
use GoDaddy\WordPress\MWC\Core\Exceptions\EventBridgeEventSendFailedException;
use GoDaddy\WordPress\MWC\Core\Http\EventBridgeRequest;

/**
 * Event bridge subscriber.
 */
class EventBridgeSubscriber implements SubscriberContract
{
    /**
     * @param EventContract $event
     */
    public function handle(EventContract $event)
    {
        if (! $this->shouldSendEvent($event)) {
            return;
        }

        try {
            $this->sendEvent($event);
        } catch (EventBridgeEventSendFailedException $exception) {
            // If an EventBridgeEventSendFailedException exception is thrown, it
            // will automatically report itself to sentry when PHP destructs the
            // object, even if it’s caught by this try-catch above.
        } catch (TokenCreateFailedException $exception) {
            // If a TokenCreateFailedException exception is thrown, we will silently
            // ignore it to avoid flooding Sentry with errors.
        }
    }

    /**
     * Determines whether the given event should be sent.
     *
     * @param EventContract $event event object
     *
     * @return bool
     */
    protected function shouldSendEvent(EventContract $event) : bool
    {
        // don't send if this is not the production environment and the plugin is not configured to send local events
        if (! ManagedWooCommerceRepository::isProductionEnvironment() && ! Configuration::get('events.send_local_events')) {
            return false;
        }

        // only send events that are an EventBridgeEventContract
        return $event instanceof EventBridgeEventContract;
    }

    /**
     * Send the Event to the streamer.
     *
     * @param EventBridgeEventContract|EventContract $event
     * @return Response
     * @throws TokenCreateFailedException
     * @throws EventBridgeEventSendFailedException
     */
    protected function sendEvent(EventContract $event) : Response
    {
        $accessToken = AuthProvider::getNewInstance()->get()->getAccessToken();

        $request = (new EventBridgeRequest())
            ->setUrl(Configuration::get('mwc.events.api.url'))
            ->setMethod('POST')
            ->setHeaders([
                'Authorization' => Configuration::get('events.auth.type', 'Bearer').' '.$accessToken,
            ])
            ->setSiteId(ManagedWooCommerceRepository::getSiteId())
            ->setBody([
                'query' => $this->getQuery($event, User::getCurrent()),
            ]);

        try {
            $response = $request->send();
        } catch (Exception $exception) {
            throw new EventBridgeEventSendFailedException("An unknown error occurred trying to send an event to EventBridge. {$exception->getMessage()}");
        }

        if ($response->isError()) {
            throw new EventBridgeEventSendFailedException($response->getErrorMessage() ?: 'Unknown error');
        }

        return $response;
    }

    /**
     * Gets the content for the query parameter.
     *
     * @param EventBridgeEventContract $event event object
     * @param User|null $user current user
     *
     * @return string
     * @throws Exception
     */
    protected function getQuery(EventBridgeEventContract $event, User $user = null)
    {
        // @NOTE: Default to 0 or anonymous when user was null as the schema requires a userId {JO: 2021-09-09}
        $userId = $user ? $user->getId() : 0;
        $data = json_encode(json_encode($this->getEventData($event)));

        return <<<GQL
mutation {
  createEvent(input: { userId: {$userId}, resource: "{$event->getResource()}", action: "{$event->getAction()}", data: {$data} }) {
    statusCode
    message
  }
}
GQL;
    }

    /**
     * Gets the event data enhanced with data that we want to include with every event.
     *
     * @param EventBridgeEventContract $event event object
     * @param User $user
     *
     * @return array
     * @throws Exception
     */
    private function getEventData(EventBridgeEventContract $event, User $user = null) : array
    {
        return ArrayHelper::combine(
            $event->getData(),
            $this->getSiteProperties(),
            $this->getUserProperties($user)
        );
    }

    /**
     * Gets the site's properties.
     *
     * @return array
     */
    protected function getSiteProperties() : array
    {
        return [
            'site' => [
                'id'              => ManagedWooCommerceRepository::getSiteId(),
                'url'             => SiteRepository::getHomeUrl(),
                'xid'             => ManagedWooCommerceRepository::getXid(),
                'uid'             => Configuration::get('godaddy.account.uid'),
                'active_plugins'  => WordPressRepository::getActivePlugins(),
                'active_features' => ManagedExtensionsRepository::getEnabledFeatures(),
                'wc_version'      => WooCommerceRepository::getWooCommerceVersion(),
                'wp_version'      => WordPressRepository::getVersion(),
                'php_version'     => PHP_VERSION,
                'plan'            => ManagedWooCommerceRepository::getPlan(),
                'platform'        => ManagedWooCommerceRepository::getPlatform(),
            ],
        ];
    }

    /**
     * Gets the user's properties.
     *
     * @param User|null $user
     * @return array
     */
    protected function getUserProperties(User $user = null) : array
    {
        if (null === $user) {
            $user = User::getCurrent();
        }

        return [
            'user' => [
                'id' => $user ? $user->getId() : 0,
            ],
            'ip' => static::getClientIp(),
        ];
    }

    /**
     * Determines the user's actual IP address and attempts to partially
     * anonymize an IP address by converting it to a network ID.
     *
     * @see \WP_Community_Events::get_unsafe_client_ip()
     *
     * @return string|false
     */
    public static function getClientIp()
    {
        $clientIp = false;

        // in order of preference, with the best ones for this purpose first
        $addressHeaders = [
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR',
        ];

        foreach ($addressHeaders as $header) {
            if (ArrayHelper::has($_SERVER, $header)) {
                /*
                 * HTTP_X_FORWARDED_FOR can contain a chain of comma-separated
                 * addresses. The first one is the original client. It can't be
                 * trusted for authenticity, but we don't need to for this purpose.
                 */
                $addressChain = explode(',', $_SERVER[$header]);
                $clientIp = trim($addressChain[0]);

                break;
            }
        }

        if (! $clientIp) {
            return false;
        }

        $anonIp = wp_privacy_anonymize_ip($clientIp, true);

        if ('0.0.0.0' === $anonIp || '::' === $anonIp) {
            return false;
        }

        return $anonIp;
    }
}
