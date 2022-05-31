<?php

namespace GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\DataStores\WooCommerce;

use DateTime;
use Exception;
use GoDaddy\WordPress\MWC\Common\Exceptions\BaseException;
use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Common\Repositories\WordPress\DatabaseRepository;
use GoDaddy\WordPress\MWC\Common\Traits\CanGetNewInstanceTrait;
use GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\Lifecycle;
use GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\Models\Checkout;
use GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\Repositories\WooCommerce\CheckoutRepository;
use GoDaddy\WordPress\MWC\Core\Payments\DataStores\Contracts\DataStoreContract;

/**
 * Checkout datastore class.
 */
class CheckoutDataStore implements DataStoreContract
{
    use CanGetNewInstanceTrait;

    /**
     * Deletes a record from the data store.
     *
     * @param int|null $id
     * @return bool
     * @throws BaseException
     */
    public function delete(int $id = null) : bool
    {
        if (null === $id) {
            throw new BaseException('Checkout ID is missing.');
        }

        return (bool) DatabaseRepository::delete(Lifecycle::CHECKOUT_DATABASE_TABLE_NAME, ['id' => $id]);
    }

    /**
     * Reads from the data store.
     *
     * @param int|null $id
     * @return Checkout|null
     * @throws BaseException|Exception
     */
    public function read(int $id = null) : ?Checkout
    {
        if (null === $id) {
            throw new BaseException('Checkout ID is missing.');
        }

        $wpdb = DatabaseRepository::instance();
        $table = Lifecycle::CHECKOUT_DATABASE_TABLE_NAME;

        $result = $wpdb->get_row(
            $wpdb->prepare("
            SELECT *
            FROM {$table}
            WHERE id = %d
            LIMIT 1
        ", (int) $id),
            ARRAY_A);

        if (empty($result)) {
            return null;
        }

        $sessionId = ArrayHelper::get($result, 'session_id', 0);

        if (! empty($sessionId)) {
            $checkout = CheckoutRepository::getFromSession($sessionId);
        } else {
            $checkout = new Checkout();
        }

        return $checkout->setId(ArrayHelper::get($result, 'id'))
            ->setEmailAddress(ArrayHelper::get($result, 'email_address', ''))
            ->setWcSessionId($sessionId)
            ->setWcCartHash(ArrayHelper::get($result, 'cart_hash', ''))
            ->setUpdatedAt(new DateTime(ArrayHelper::get($result, 'updated_at', 'now')));
    }

    /**
     * Gets the latest checkout record for a given email address.
     *
     * @param string $emailAddress
     * @return Checkout|null
     * @throws BaseException|Exception
     */
    public function findLatestByEmailAddress(string $emailAddress) : ?Checkout
    {
        $wpdb = DatabaseRepository::instance();
        $table = Lifecycle::CHECKOUT_DATABASE_TABLE_NAME;

        $result = $wpdb->get_row(
            $wpdb->prepare("
            SELECT *
            FROM {$table}
            WHERE email_address = %s
            ORDER BY updated_at DESC
            LIMIT 1
        ", $emailAddress),
            ARRAY_A);

        if (empty($result)) {
            return null;
        }

        $sessionId = ArrayHelper::get($result, 'session_id', 0);

        if (! empty($sessionId)) {
            $checkout = CheckoutRepository::getFromSession($sessionId);
        } else {
            $checkout = new Checkout();
        }

        return $checkout->setId(ArrayHelper::get($result, 'id'))
            ->setEmailAddress(ArrayHelper::get($result, 'email_address', ''))
            ->setWcSessionId($sessionId)
            ->setWcCartHash(ArrayHelper::get($result, 'cart_hash', ''))
            ->setUpdatedAt(new DateTime(ArrayHelper::get($result, 'updated_at', 'now')));
    }

    /**
     * Saves a record to the data store.
     *
     * @param Checkout|null $checkout
     * @return Checkout
     * @throws BaseException
     */
    public function save(Checkout $checkout = null) : Checkout
    {
        if (null === $checkout) {
            throw new BaseException('Checkout object is missing.');
        }

        if ($checkout->isNew()) {
            // insert new checkout (ID will be set automatically)
            $result = DatabaseRepository::insert(Lifecycle::CHECKOUT_DATABASE_TABLE_NAME, [
                'session_id'    => $checkout->getWcSessionId(),
                'email_address' => $checkout->getEmailAddress(),
                'cart_hash'     => $checkout->getWcCartHash(),
            ]);
            if ($result) {
                $checkout->setId($result);
            }
        } elseif (empty(static::read($checkout->getId()))) {
            // insert checkout with the same ID back (WC session was deleted and checkout was cascade deleted)
            DatabaseRepository::insert(Lifecycle::CHECKOUT_DATABASE_TABLE_NAME, [
                'id'            => $checkout->getId(),
                'session_id'    => $checkout->getWcSessionId(),
                'email_address' => $checkout->getEmailAddress(),
                'cart_hash'     => $checkout->getWcCartHash(),
            ]);
        } else {
            $checkout->setUpdatedAt(new DateTime());
            // update existing checkout
            DatabaseRepository::update(Lifecycle::CHECKOUT_DATABASE_TABLE_NAME, [
                'session_id'    => $checkout->getWcSessionId(),
                'email_address' => $checkout->getEmailAddress(),
                'cart_hash'     => $checkout->getWcCartHash(),
                'updated_at'    => $checkout->getUpdatedAt()->format('Y-m-d H:i:s'),
            ], [
                'id' => $checkout->getId(),
            ]
            );
        }

        return $checkout;
    }
}
