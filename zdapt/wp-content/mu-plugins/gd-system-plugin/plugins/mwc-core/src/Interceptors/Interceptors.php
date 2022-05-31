<?php

namespace GoDaddy\WordPress\MWC\Core\Interceptors;

use GoDaddy\WordPress\MWC\Common\Components\Contracts\ComponentContract;
use GoDaddy\WordPress\MWC\Common\Components\Exceptions\ComponentClassesNotDefinedException;
use GoDaddy\WordPress\MWC\Common\Components\Exceptions\ComponentLoadFailedException;
use GoDaddy\WordPress\MWC\Common\Components\Traits\HasComponentsTrait;
use GoDaddy\WordPress\MWC\Core\Features\GiftCertificates\Interceptors\GiftCertificateInterceptor;
use GoDaddy\WordPress\MWC\Core\Payments\Poynt\Interceptors\PullProductsActionInterceptor;
use GoDaddy\WordPress\MWC\Core\Payments\Poynt\Interceptors\PushProductsActionInterceptor;
use GoDaddy\WordPress\MWC\Core\WooCommerce\Interceptors\CouponInterceptor;
use GoDaddy\WordPress\MWC\Core\WooCommerce\Interceptors\CustomerInterceptor;
use GoDaddy\WordPress\MWC\Core\WooCommerce\Interceptors\OrderInterceptor;
use GoDaddy\WordPress\MWC\Core\WooCommerce\Interceptors\ProductInterceptor;
use GoDaddy\WordPress\MWC\Core\WordPress\Interceptors\ReviewInterceptor;

/**
 * The Interceptors class instantiates AbstractInterceptor instances for hooking into actions and filters.
 */
class Interceptors implements ComponentContract
{
    use HasComponentsTrait;

    /** @var string[] list of class names that extend AbstractInterceptor */
    protected $componentClasses = [
        CouponInterceptor::class,
        CustomerInterceptor::class,
        GiftCertificateInterceptor::class,
        OrderInterceptor::class,
        ProductInterceptor::class,
        PullProductsActionInterceptor::class,
        PushProductsActionInterceptor::class,
        ReviewInterceptor::class,
    ];

    /**
     * {@inheritDoc}
     *
     * @throws ComponentClassesNotDefinedException|ComponentLoadFailedException
     */
    public function load()
    {
        $this->loadComponents();
    }
}
