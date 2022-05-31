<?php

namespace GoDaddy\WordPress\MWC\Core\Auth\ManagedWooCommerce\Models;

use GoDaddy\WordPress\MWC\Common\Models\AbstractModel;
use GoDaddy\WordPress\MWC\Common\Traits\CanBulkAssignPropertiesTrait;

/**
 * Managed WooCommerce JWT Token.
 */
class Token extends AbstractModel
{
    use CanBulkAssignPropertiesTrait;
    /** @var string A JWT Access token */
    protected $accessToken = '';

    /** @var string The list of scopes for the JWT separated by space */
    protected $scope = '';

    /** @var string The ID for the token */
    protected $tokenId = '';

    /** @var string The type of token used */
    protected $tokenType = 'BEARER';

    /** @var int The expiration timestamp */
    protected $expiration = 0;

    /**
     * Constructor.
     */
    final public function __construct()
    {
        // to prevent overriding the constructor.
    }

    /**
     * Retrieves the access token.
     *
     * @return string The token value.
     */
    public function getAccessToken() : string
    {
        return $this->accessToken;
    }

    /**
     * Retrieves the list of scopes, as a string.
     *
     * @return string List of scopes, separated by a space.
     */
    public function getScope() : string
    {
        return $this->scope;
    }

    /**
     * Retrieves the access token ID.
     *
     * @return string The ID.
     */
    public function getTokenId() : string
    {
        return $this->tokenId;
    }

    /**
     * Retrieves the access token type.
     *
     * @return string The type.
     */
    public function getTokenType() : string
    {
        return $this->tokenType;
    }

    /**
     * Retrieves the expiration timestamp.
     *
     * @return int The expiration.
     */
    public function getExpiration() : int
    {
        return $this->expiration;
    }

    /**
     * Sets the access token.
     *
     * @return $this The token instance.
     */
    public function setAccessToken($token) : Token
    {
        $this->accessToken = $token;

        return $this;
    }

    /**
     * Sets the scope.
     *
     * @return $this The token instance.
     */
    public function setScope($scope) : Token
    {
        $this->scope = $scope;

        return $this;
    }

    /**
     * Sets the token ID.
     *
     * @return $this The token instance.
     */
    public function setTokenId($tokenId) : Token
    {
        $this->tokenId = $tokenId;

        return $this;
    }

    /**
     * Sets the token type.
     *
     * @return $this The token instance.
     */
    public function setTokenType($tokenType) : Token
    {
        $this->tokenType = $tokenType;

        return $this;
    }

    /**
     * Sets the expiration timestamp.
     *
     * @return $this The token instance.
     */
    public function setExpiration($expiration) : Token
    {
        $this->expiration = $expiration;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray() : array
    {
        $data = parent::toArray();
        $data['expiresIn'] = $this->getExpiresIn();

        return $data;
    }

    /**
     * Retrieves the number of seconds before this token expires, based on the expiration date.
     *
     * @return int Seconds before this token expires.
     */
    public function getExpiresIn() : int
    {
        return $this->getExpiration() - time();
    }
}
