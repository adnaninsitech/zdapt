<?php

namespace GoDaddy\WordPress\MWC\Core\Auth\ManagedWooCommerce\Exceptions;

use GoDaddy\WordPress\MWC\Common\Exceptions\BaseException;

/**
 * Exception thrown when the platform JWT is not available.
 *
 * This exception should not be reported to Sentry to avoid flooding our systems when
 * a site is unable to generate a token for external reasons.
 *
 * For example:
 *
 * - Staging sites in the MWP platform currently can't generate a JWT
 */
class TokenCreateFailedException extends BaseException
{
}
