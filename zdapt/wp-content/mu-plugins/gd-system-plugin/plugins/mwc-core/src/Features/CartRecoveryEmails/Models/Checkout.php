<?php

namespace GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\Models;

use GoDaddy\WordPress\MWC\Common\Events\Events;
use GoDaddy\WordPress\MWC\Common\Events\Exceptions\EventTransformFailedException;
use GoDaddy\WordPress\MWC\Common\Exceptions\BaseException;
use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\DataStores\WooCommerce\CheckoutDataStore;

class Checkout extends \GoDaddy\WordPress\MWC\Common\Models\Checkout
{
    /** @var int */
    protected $wcSessionId;

    /** @var string */
    protected $wcCartHash;

    /** @var string|null */
    protected $status;

    /** @var CheckoutDataStore */
    protected $checkoutDataStore;

    /**
     * Checkout constructor.
     */
    public function __construct()
    {
        $this->checkoutDataStore = CheckoutDataStore::getNewInstance();
    }

    /**
     * Gets the Session ID.
     *
     * @return int
     */
    public function getWcSessionId() : int
    {
        return $this->wcSessionId ?: 0;
    }

    /**
     * Gets the hash for the associated cart session.
     *
     * @return string
     */
    public function getWcCartHash() : string
    {
        return $this->wcCartHash ?: '';
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        //@TODO - implement when have way of identifying whether a checkout is recovered {WS - 2022-02-01}
    }

    /**
     * Sets the Session ID.
     *
     * @param int $value
     * @return Checkout
     */
    public function setWcSessionId(int $value)
    {
        $this->wcSessionId = $value;

        return $this;
    }

    /**
     * Sets the cart hash.
     *
     * @param string $value
     * @return $this
     */
    public function setWcCartHash(string $value) : Checkout
    {
        $this->wcCartHash = $value;

        return $this;
    }

    /**
     * Creates a new instance of Checkout and saves it to the database.
     *
     * @param array $propertyValues checkout data
     * @return Checkout
     * @throws BaseException
     * @throws EventTransformFailedException
     */
    public static function create(array $propertyValues = []) : Checkout
    {
        parent::create();

        if (! ArrayHelper::has($propertyValues, ['wcSessionId', 'emailAddress'])) {
            throw new BaseException('Checkout::create() requires both WC Session ID and E-mail Address');
        }

        $checkout = static::seed($propertyValues);

        $checkout->save();

        return $checkout;
    }

    /**
     * Deletes a given instance of Checkout from the database.
     *
     * @return bool
     * @throws BaseException
     * @throws EventTransformFailedException
     */
    public function delete() : bool
    {
        parent::delete();

        $result = $this->checkoutDataStore->delete($this->getId());

        Events::broadcast($this->buildEvent('checkout', 'delete'));

        return $result;
    }

    /**
     * Saves a given instance of Checkout to the database.
     *
     * @return Checkout
     * @throws BaseException
     */
    public function save() : Checkout
    {
        if ($this->isNew()) {
            Events::broadcast($this->buildEvent('checkout', 'create'));
        } else {
            Events::broadcast($this->buildEvent('checkout', 'update'));
        }

        return $this->checkoutDataStore->save($this);
    }
}
