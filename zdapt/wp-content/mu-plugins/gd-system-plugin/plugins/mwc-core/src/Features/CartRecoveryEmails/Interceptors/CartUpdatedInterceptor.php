<?php

namespace GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\Interceptors;

use Exception;
use GoDaddy\WordPress\MWC\Common\Exceptions\BaseException;
use GoDaddy\WordPress\MWC\Common\Interceptors\AbstractInterceptor;
use GoDaddy\WordPress\MWC\Common\Models\User;
use GoDaddy\WordPress\MWC\Common\Register\Register;
use GoDaddy\WordPress\MWC\Common\Repositories\WooCommerce\CartRepository;
use GoDaddy\WordPress\MWC\Common\Repositories\WooCommerce\SessionRepository;
use GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\DataStores\WooCommerce\CheckoutDataStore;
use GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\Repositories\WooCommerce\CheckoutRepository;
use WC_Cart_Session;

/**
 * Interceptor for WooCommerce cart updates.
 */
class CartUpdatedInterceptor extends AbstractInterceptor
{
    /**
     * Adds hooks.
     *
     * @throws Exception
     */
    public function addHooks()
    {
        /* @see WC_Cart_Session::set_session() */
        Register::action()
            ->setGroup('woocommerce_cart_updated')
            ->setHandler([$this, 'saveCheckout'])
            ->setPriority(PHP_INT_MAX)
            ->execute();
    }

    /**
     * Saves or updates the checkout data for the customer or guest.
     *
     * @internal
     *
     * @throws BaseException|Exception
     */
    public function saveCheckout()
    {
        $checkout = CheckoutRepository::getFromSession();

        if (empty($checkout)) {
            return;
        }

        // gets the current WC cart hash, that will be different if the cart contents change
        $wcCurrentCartHash = CartRepository::getHash() ?: '';

        if (! $checkout->isNew()) {
            // get the checkout object stored in the custom table
            $savedCheckout = CheckoutDataStore::getNewInstance()->read($checkout->getId());

            $savedHash = $savedCheckout ? $savedCheckout->getWcCartHash() : '';

            // bail if the cart contents have not changed
            if (hash_equals($wcCurrentCartHash, $savedHash)) {
                return;
            }
        }

        $checkout->setWcCartHash($wcCurrentCartHash);

        if (! empty($user = User::getCurrent())) {
            // for logged-in customers, their registered email always takes precedence
            $checkout->setEmailAddress($user->getEmail());
        } elseif (! empty($savedCheckout)) {
            // prevent the email from being reset accidentally
            $checkout->setEmailAddress($savedCheckout->getEmailAddress());
        }

        $checkout->save();

        SessionRepository::set('checkout_id', $checkout->getId());
    }
}
