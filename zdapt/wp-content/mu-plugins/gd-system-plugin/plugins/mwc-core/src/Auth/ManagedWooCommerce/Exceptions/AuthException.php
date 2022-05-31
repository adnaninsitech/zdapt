<?php

namespace GoDaddy\WordPress\MWC\Core\Auth\ManagedWooCommerce\Exceptions;

use GoDaddy\WordPress\MWC\Common\Exceptions\SentryException;

/**
 * Exception to report to Sentry that an error occurred trying to authenticate with MWC site.
 */
class AuthException extends SentryException
{
}
