<?php

namespace GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\Interceptors;

use Exception;
use GoDaddy\WordPress\MWC\Common\Exceptions\SentryException;
use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Common\Helpers\ValidationHelper;
use GoDaddy\WordPress\MWC\Common\Interceptors\AbstractInterceptor;
use GoDaddy\WordPress\MWC\Common\Models\User;
use GoDaddy\WordPress\MWC\Common\Register\Register;
use GoDaddy\WordPress\MWC\Common\Repositories\WooCommerceRepository;
use GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\CartRecoveryEmails;
use GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\Settings\OptOutSetting;

/**
 * WooCommerce checkout interceptor.
 */
class CheckoutInterceptor extends AbstractInterceptor
{
    /**
     * Adds hooks.
     *
     * @throws Exception
     */
    public function addHooks()
    {
        Register::filter()
            ->setGroup('woocommerce_checkout_fields')
            ->setHandler([$this, 'addCartRecoveryEmailsOptOutField'])
            ->setCondition(static function () {
                return CartRecoveryEmails::allowsCustomersOptOut();
            })
            ->execute();

        Register::filter()
            ->setGroup('woocommerce_checkout_get_value')
            ->setHandler([$this, 'getCartRecoveryEmailsOptOutFieldValue'])
            ->setArgumentsCount(2)
            ->setCondition(static function () {
                return CartRecoveryEmails::allowsCustomersOptOut();
            })
            ->execute();

        Register::action()
            ->setGroup('woocommerce_after_checkout_validation')
            ->setHandler([$this, 'processCartRecoveryEmailsOptOutField'])
            ->setCondition(static function () {
                return CartRecoveryEmails::allowsCustomersOptOut();
            })
            ->execute();
    }

    /**
     * Adds a cart recovery opt out checkbox field next to the WooCommerce billing email checkout form field.
     *
     * @internal
     * @see \WC_Checkout::get_checkout_fields()
     * @see \woocommerce_form_field()
     *
     * @param mixed|array $checkoutFields
     * @return mixed|array
     * @throws Exception
     */
    public function addCartRecoveryEmailsOptOutField($checkoutFields)
    {
        if (! ArrayHelper::has($checkoutFields, 'billing.billing_email') || ! WooCommerceRepository::isCheckoutPage()) {
            return $checkoutFields;
        }

        $optOutSetting = new OptOutSetting();
        $optOutField = [
            $optOutSetting->getName() => [
                'required' => false,
                'type'     => 'checkbox',
                'label'    => $optOutSetting->getLabel(),
                'default'  => 1, // will determine the checkbox to be checked by default
            ],
        ];

        $billingFields = ArrayHelper::insertAfter(ArrayHelper::get($checkoutFields, 'billing', []), $optOutField, 'billing_email');

        if ($billingFields) {
            $checkoutFields['billing'] = $billingFields;
        }

        return $checkoutFields;
    }

    /**
     * Gets the cart recovery opt out field value.
     *
     * @internal
     * @see \WC_Checkout::get_value()
     *
     * @param mixed|bool $value
     * @param mixed|string $fieldName
     * @return mixed|bool
     */
    public function getCartRecoveryEmailsOptOutFieldValue($value, $fieldName)
    {
        if (null !== $value || $fieldName !== (new OptOutSetting())->getName()) {
            return $value;
        }

        if ($currentUser = User::getCurrent()) {
            // if the user has opted out, then we return the inverse value (the checkbox will be checked if they have opted in)
            return ! OptOutSetting::get($currentUser->getEmail());
        }

        return $value;
    }

    /**
     * Processes the cart recovery emails opt out preference.
     *
     * This is done while the checkout form validates, so we can store the preference regardless of checkout errors.
     *
     * @internal
     * @see \WC_Checkout::validate_checkout()
     *
     * @param mixed|array $checkoutFormData
     * @throws Exception
     */
    public function processCartRecoveryEmailsOptOutField($checkoutFormData)
    {
        $optOutSetting = OptOutSetting::getNewInstance();
        $emailAddress = ArrayHelper::get($checkoutFormData, 'billing_email');
        $optIn = (bool) ArrayHelper::get($checkoutFormData, $optOutSetting->getName());

        // if the current user is logged in, use their email address to store their preference instead
        if ($user = User::getCurrent()) {
            $emailAddress = $user->getEmail();
        }

        // it's fine to bail out early here or invalid, as WooCommerce validation should take care of that anyway
        if (! ValidationHelper::isEmail($emailAddress)) {
            return;
        }

        try {
            if ($optIn) {
                $optOutSetting->delete($emailAddress);
            } else {
                $optOutSetting->save($emailAddress);
            }
        } catch (Exception $e) {
            // at this point we might be interested in logging database errors only
            new SentryException($e->getMessage());
        }
    }
}
