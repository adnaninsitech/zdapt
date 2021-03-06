<?php

namespace GoDaddy\WordPress\MWC\Common\Http;

use Exception;
use GoDaddy\WordPress\MWC\Common\Configuration\Configuration;
use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Common\Repositories\WordPressRepository;

/**
 * Request handler for performing requests to GoDaddy.
 *
 * This class also wraps a Managed WooCommerce Site Token required by GoDaddy requests.
 *
 * @since 1.0.0
 */
class GoDaddyRequest extends Request
{
    /** @var string managed WooCommerce site token */
    public $siteToken;

    /** @var string Managed WooCommerce site's account UID */
    protected $accountUid;

    /** @var string locale */
    protected $locale;

    /**
     * Constructor.
     *
     * @since 1.0.0
     *
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();

        $this->siteToken()
            ->setAccountUid()
            ->setHeaders([
                'X-Site-Token'  => $this->siteToken,
                'X-Account-UID' => $this->getAccountUid(),
            ]);

        $this->setLocale();
    }

    /**
     * Gets site's account UID.
     *
     * @return string|null
     */
    public function getAccountUid()
    {
        return $this->accountUid;
    }

    /**
     * Sets the site's account UID.
     *
     * @param string $accountUid
     *
     * @return GoDaddyRequest
     */
    public function setAccountUid(string $accountUid = null) : GoDaddyRequest
    {
        $this->accountUid = $accountUid ?: Configuration::get('godaddy.account.uid', '');

        return $this;
    }

    /**
     * Builds a valid url string with parameters.
     *
     * @since 3.4.1
     *
     * @return string
     * @throws Exception
     */
    protected function buildUrlString() : string
    {
        if ($this->locale) {
            if (! isset($this->query)) {
                $this->query = [];
            }

            ArrayHelper::set($this->query, 'locale', $this->locale);
        }

        return parent::buildUrlString();
    }

    /**
     * Sets the current site API request token.
     *
     * @since 1.0.0
     *
     * @param string|null $token
     * @return GoDaddyRequest
     * @throws Exception
     */
    public function siteToken(string $token = null) : GoDaddyRequest
    {
        $this->siteToken = $token ?: Configuration::get('godaddy.site.token', 'empty');

        return $this;
    }

    /**
     * Sets the locale.
     *
     * @since 3.4.1
     *
     * @param string $locale
     * @return GoDaddyRequest
     * @throws Exception
     */
    public function setLocale(string $locale = '') : GoDaddyRequest
    {
        if (empty($locale)) {
            $locale = WordPressRepository::getLocale();
        }

        $this->locale = $locale;

        return $this;
    }
}
