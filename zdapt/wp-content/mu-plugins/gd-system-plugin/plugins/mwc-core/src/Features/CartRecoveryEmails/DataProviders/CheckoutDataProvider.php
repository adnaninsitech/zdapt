<?php

namespace GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\DataProviders;

use Exception;
use GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\CurrencyAmountAdapter;
use GoDaddy\WordPress\MWC\Common\Models\Cart;
use GoDaddy\WordPress\MWC\Common\Models\Orders\LineItem;
use GoDaddy\WordPress\MWC\Common\Repositories\WordPress\SiteRepository;
use GoDaddy\WordPress\MWC\Core\Features\CartRecoveryEmails\Contracts\CheckoutEmailNotificationContract;
use GoDaddy\WordPress\MWC\Core\Features\EmailNotifications\Contracts\DataProviderContract;

/**
 * A provider for email notifications to handle data for recoverable carts.
 */
class CheckoutDataProvider implements DataProviderContract
{
    /** @var CheckoutEmailNotificationContract */
    protected $emailNotification;

    /**
     * Constructor.
     */
    public function __construct(CheckoutEmailNotificationContract $emailNotification)
    {
        $this->emailNotification = $emailNotification;
    }

    /**
     * Gets checkout data.
     *
     * @return array
     * @throws Exception
     */
    public function getData() : array
    {
        $checkout = $this->emailNotification->getCheckout();

        if (! $checkout) {
            return [];
        }

        $customer = $checkout->getCustomer();

        $domain = SiteRepository::getDomain();

        return [
            'customer_first_name' => $customer ? $customer->getFirstName() : '',
            'customer_last_name'  => $customer ? $customer->getLastName() : '',
            'site_address'        => $domain,
            'site_title'          => SiteRepository::getTitle(),
            'site_url'            => $domain,
            'internal'            => [
                'cart_details' => $this->getCartDetails($checkout->getCart()),
            ],
        ];
    }

    /**
     * Gets checkout placeholders.
     *
     * @return string[]
     */
    public function getPlaceholders() : array
    {
        return [
            'customer_first_name',
            'customer_last_name',
            'site_address',
            'site_title',
            'site_url',
        ];
    }

    /**
     * Gets the cart details data.
     *
     * @param Cart $cart
     * @return array
     */
    protected function getCartDetails(Cart $cart) : array
    {
        return [
            /* @TODO implement the cart recovery link {unfulvio 2022-03-10} */
            'cart_recovery_link' => '',
            'currency'           => $cart->getTotalAmount()->getCurrencyCode(),
            'total'              => (new CurrencyAmountAdapter(0, 'USD'))->convertToSource($cart->getTotalAmount()),
            'line_items'         => $this->getLineItemsData($cart->getLineItems()),
        ];
    }

    /**
     * Gets the line items data.
     *
     * @param LineItem[] $lineItems
     * @return array
     */
    protected function getLineItemsData(array $lineItems) : array
    {
        $amountAdapter = new CurrencyAmountAdapter(0, 'USD');
        $data = [];

        foreach ($lineItems as $lineItem) {
            $product = $lineItem->getProduct();

            $data[] = [
                'name'         => $lineItem->getName(),
                'variation_id' => $lineItem->getVariationId(),
                'quantity'     => $lineItem->getQuantity(),
                'price'        => $amountAdapter->convertToSource($lineItem->getSubTotalAmount()),
                'tax'          => $amountAdapter->convertToSource($lineItem->getTaxAmount()),
                'total'        => $amountAdapter->convertToSource($lineItem->getTotalAmount()),
                'product'      => [
                    'id'        => $product->get_id(),
                    'permalink' => $product->get_permalink(),
                    'name'      => $product->get_name(),
                    'image'     => [
                        'id'  => $product->get_image_id(),
                        'src' => $product->get_image(),
                        /* @TODO implement repository methods to retrieve image from WordPress gallery and corresponding title/alt values {unfulvio 2022-03-10} */
                        'name' => $product->get_name(),
                        'alt'  => $product->get_name(),
                    ],
                ],
            ];
        }

        return $data;
    }
}
