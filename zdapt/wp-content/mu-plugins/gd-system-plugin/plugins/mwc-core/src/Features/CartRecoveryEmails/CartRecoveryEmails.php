<?php

namespace GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails;

use Exception;
use GoDaddy\WordPress\MWC\Common\Components\Traits\HasComponentsTrait;
use GoDaddy\WordPress\MWC\Common\Configuration\Configuration;
use GoDaddy\WordPress\MWC\Common\Features\AbstractFeature;
use GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\Interceptors\AjaxInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\Interceptors\CartUpdatedInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\Interceptors\CheckoutInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\Interceptors\CheckoutScriptsInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\Interceptors\SessionExpirationInterceptor;

/**
 * The Cart Recovery Emails feature loader.
 */
class CartRecoveryEmails extends AbstractFeature
{
    use HasComponentsTrait;

    /** @var array alphabetically ordered list of components to load */
    protected $componentClasses = [
        AjaxInterceptor::class,
        Lifecycle::class,
        CartUpdatedInterceptor::class,
        CheckoutInterceptor::class,
        CheckoutScriptsInterceptor::class,
        SessionExpirationInterceptor::class,
    ];

    /**
     * {@inheritdoc}
     */
    public static function getName() : string
    {
        return 'cart_recovery_emails';
    }

    /**
     * Initializes the feature.
     *
     * @throws Exception
     */
    public function load()
    {
        $this->loadComponents();
    }

    /**
     * Determines whether customers are allowed to opt out from receiving cart recovery emails.
     *
     * @return bool
     */
    public static function allowsCustomersOptOut() : bool
    {
        /* @TODO ensure the default value of this configuration flag {unfulvio 2022-03-03} */
        return (bool) Configuration::get('features.cart_recovery_emails.allow_customers_opt_out', true);
    }
}
