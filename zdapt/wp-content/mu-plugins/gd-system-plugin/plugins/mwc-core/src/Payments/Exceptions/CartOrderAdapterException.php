<?php

namespace GoDaddy\WordPress\MWC\Core\Payments\Exceptions;

use GoDaddy\WordPress\MWC\Common\Exceptions\BaseException;

/**
 * An exception to be thrown when an order from a cart is invalid.
 */
class CartOrderAdapterException extends BaseException
{
    public function __construct(string $message, int $code = null)
    {
        if ($code) {
            $this->code = $code;
        }
        parent::__construct($message);
    }
}
