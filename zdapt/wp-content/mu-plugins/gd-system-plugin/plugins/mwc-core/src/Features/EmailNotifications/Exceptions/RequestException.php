<?php

namespace GoDaddy\WordPress\MWC\Core\Features\EmailNotifications\Exceptions;

use GoDaddy\WordPress\MWC\Common\Exceptions\BaseException;

/**
 * An exception to be thrown if an error occurs in the response.
 */
class RequestException extends BaseException
{
    public function __construct(string $message, int $code = null)
    {
        if ($code) {
            $this->code = $code;
        }
        parent::__construct($message);
    }
}
