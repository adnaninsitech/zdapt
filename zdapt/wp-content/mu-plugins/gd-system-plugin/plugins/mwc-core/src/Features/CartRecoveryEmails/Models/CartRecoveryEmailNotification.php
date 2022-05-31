<?php

namespace GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\Models;

use DateInterval;
use DateTime;
use Exception;
use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\CartRecoveryEmails;
use GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\Contracts\CheckoutEmailNotificationContract;
use GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\DataProviders\CheckoutDataProvider;
use GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\Settings\OptOutSetting;
use GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\Traits\IsCheckoutEmailNotificationTrait;
use GoDaddy\WordPress\MWC\Core\Features\EmailNotifications\Contracts\ConditionalEmailNotificationContract;
use GoDaddy\WordPress\MWC\Core\Features\EmailNotifications\Contracts\DelayableEmailNotificationContract;
use GoDaddy\WordPress\MWC\Core\Features\EmailNotifications\Models\EmailNotification;
use GoDaddy\WordPress\MWC\Core\Features\EmailNotifications\Models\EmailNotificationSetting;
use GoDaddy\WordPress\MWC\Core\Features\EmailNotifications\Traits\IsDelayableEmailNotificationTrait;

/**
 * Email notification for cart recovery emails.
 */
class CartRecoveryEmailNotification extends EmailNotification implements CheckoutEmailNotificationContract, ConditionalEmailNotificationContract, DelayableEmailNotificationContract
{
    use IsCheckoutEmailNotificationTrait;
    use IsDelayableEmailNotificationTrait;

    /** @var string */
    protected $id = 'cart_recovery';

    /** @var string[] */
    protected $categories = ['campaigns'];

    /**
     * Configures the email notification.
     */
    public function __construct()
    {
        $this->setName($this->getId())
            ->setLabel(__('Cart Recovery', 'mwc-core'))
            ->setDescription(__("Send a reminder email to customers that left products in their cart but didn't complete the checkout.", 'mwc-core'));
    }

    /**
     * Gets the email notification's initial data providers.
     *
     * @throws Exception
     */
    protected function getInitialDataProviders() : array
    {
        return ArrayHelper::combine(parent::getInitialDataProviders(), [
            new CheckoutDataProvider($this),
        ]);
    }

    /**
     * Gets the email notification's initial settings.
     *
     * @return EmailNotificationSetting[]
     */
    protected function getInitialSettings() : array
    {
        /* @TODO confirm email notification default subject {unfulvio 2022-03-08} */
        return [
            $this->getEnabledSettingObject(),
            $this->getSubjectSettingObject()->setDefault(__('Hey there {{customer.first_name}}, did you forgot something?', 'mwc-core')),
            $this->getDelayValueSettingObject(),
            $this->getDelayUnitSettingObject(),
        ];
    }

    /**
     * Determines whether the email notification is available.
     *
     * @return bool
     */
    public function isAvailable() : bool
    {
        return CartRecoveryEmails::shouldLoad();
    }

    /**
     * Determines whether the email should be sent.
     *
     * @return bool
     */
    public function shouldSend() : bool
    {
        if (empty($checkout = $this->getCheckout())) {
            return false;
        }

        if (! empty(OptOutSetting::get($checkout->getEmailAddress()))) {
            return false;
        }

        if (empty($checkout->getWcCartHash())) {
            return false;
        }

        return true;
    }

    /**
     * Determines the DateTime the email should be scheduled for.
     *
     * @return DateTime|null
     */
    public function sendAt() : ?DateTime
    {
        if (empty($checkout = $this->getCheckout())) {
            return null;
        }

        try {
            $delay = DateInterval::createFromDateString("{$this->getDelayValue()} {$this->getDelayUnit()}");
        } catch (Exception $exception) {
            // configured delay is invalid, ignore it
            return null;
        }

        return $checkout->getUpdatedAt()->add($delay);
    }
}
