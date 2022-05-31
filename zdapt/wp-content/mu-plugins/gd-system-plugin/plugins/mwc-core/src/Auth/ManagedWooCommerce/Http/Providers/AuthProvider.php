<?php

namespace GoDaddy\WordPress\MWC\Core\Auth\ManagedWooCommerce\Http\Providers;

use Exception;
use GoDaddy\WordPress\MWC\Common\Configuration\Configuration;
use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Common\Helpers\StringHelper;
use GoDaddy\WordPress\MWC\Common\Http\GoDaddyRequest;
use GoDaddy\WordPress\MWC\Common\Models\User;
use GoDaddy\WordPress\MWC\Common\Repositories\ManagedWooCommerceRepository;
use GoDaddy\WordPress\MWC\Common\Traits\CanGetNewInstanceTrait;
use GoDaddy\WordPress\MWC\Core\Auth\ManagedWooCommerce\Cache\Types\CacheErrorResponse;
use GoDaddy\WordPress\MWC\Core\Auth\ManagedWooCommerce\Cache\Types\CacheToken;
use GoDaddy\WordPress\MWC\Core\Auth\ManagedWooCommerce\Exceptions\AuthProviderException;
use GoDaddy\WordPress\MWC\Core\Auth\ManagedWooCommerce\Exceptions\TokenCreateFailedException;
use GoDaddy\WordPress\MWC\Core\Auth\ManagedWooCommerce\Models\Token;

/**
 * Provider for MWC authentication tokens.
 */
class AuthProvider
{
    use CanGetNewInstanceTrait;

    /**
     * Attempts to retrieve cached token. Otherwise, will request a new token.
     *
     * @return Token
     * @throws TokenCreateFailedException
     */
    public function get() : Token
    {
        $userId = $this->getCurrentUserId();

        return $this->getTokenFromCache($userId) ?? $this->requestTokenWithErrorCache($userId);
    }

    /**
     * Attempts to retrieve the token from the cache, if it is cached.
     *
     * @return Token|null The token instance if cached, otherwise null.
     */
    protected function getTokenFromCache($userId)
    {
        $data = $this->getTokenCache($userId)->get();

        // Bail if there's no data to get.
        if (null === $data) {
            return null;
        }

        return Token::seed(ArrayHelper::wrap($data));
    }

    /**
     * Tries to requests a new token from the MWC API.
     *
     * It caches error responses to avoid issuing a large number of requests that fail in a short period of time.
     *
     * @param int|null $userId
     * @return Token
     * @throws TokenCreateFailedException
     */
    protected function requestTokenWithErrorCache(int $userId = null) : Token
    {
        if (! is_null(CacheErrorResponse::getInstance()->get())) {
            throw new TokenCreateFailedException('Could not create a token.');
        }

        try {
            return $this->requestToken($userId);
        } catch (AuthProviderException $exception) {
            CacheErrorResponse::getInstance()->set($exception->getMessage());

            throw new TokenCreateFailedException('Could not create a token.');
        }
    }

    /**
     * Requests a new token from the MWC API.
     *
     * @param int|null $userId
     * @return Token
     * @throws AuthProviderException
     */
    protected function requestToken(int $userId = null) : Token
    {
        try {
            $response = $this->getTokenRequest($userId)->send();
        } catch (Exception $exception) {
            throw new AuthProviderException("An unknown error occurred trying to create a token. {$exception->getMessage()}");
        }

        if ($response->getStatus() === 403) {
            $message = ArrayHelper::get($response->getBody(), 'message', 'Unauthorized');

            throw new AuthProviderException("Not authorized to create a token: {$message}");
        }

        if ($response->isError() || ! ArrayHelper::has($response->getBody(), 'accessToken')) {
            throw new AuthProviderException("API responded with status {$response->getStatus()}, error: {$response->getErrorMessage()}");
        }

        $tokenData = (array) $response->getBody();
        $token = Token::seed($tokenData);

        // Get the cache expiration based on the JWT.
        $expiration = $this->getCacheExpiration($token);

        $this->getTokenCache($userId)->expires($expiration)->set($tokenData);

        return $token;
    }

    /**
     * Gets a proper MWC API request instance to get site token.
     *
     * @param int|null $userId
     * @return GoDaddyRequest
     */
    protected function getTokenRequest(int $userId = null) : GoDaddyRequest
    {
        return (new GoDaddyRequest())
            ->addHeaders([
                'Accept' => 'application/json',
            ])
            ->setUrl(StringHelper::trailingSlash(Configuration::get('mwc.extensions.api.url')).'mwp/token')
            ->setBody([
                'siteId' => ManagedWooCommerceRepository::getSiteId(),
                'userId' => $userId ?: 0,
            ])
            ->setMethod('POST');
    }

    /**
     * Gets current logged-in user ID.
     *
     * @return int|null
     */
    protected function getCurrentUserId()
    {
        $user = User::getCurrent();

        return $user ? $user->getId() : null;
    }

    /**
     * Retrieves the token from the cache.
     *
     * @param int|null $userId
     * @return CacheToken The token for the current user, or an anonymous token when no user is logged in.
     */
    protected function getTokenCache(int $userId = null) : CacheToken
    {
        return CacheToken::for($userId);
    }

    /**
     * Clears the cached token.
     *
     * @return AuthProvider self
     */
    public function forget() : AuthProvider
    {
        $this->getTokenCache($this->getCurrentUserId())->clear();

        return $this;
    }

    /**
     * Calculates the number of seconds the cache should expire relative to the web token's expiration time.
     *
     * @param Token $token The token from which the expiration time should be calculated.
     * @return int The number of seconds that can pass before this token should expire.
     */
    protected function getCacheExpiration(Token $token) : int
    {
        $expires = $token->getExpiresIn() - 300;

        // Expiration should not be less than zero.
        if ($expires < 0) {
            return 0;
        }

        return $expires;
    }
}
