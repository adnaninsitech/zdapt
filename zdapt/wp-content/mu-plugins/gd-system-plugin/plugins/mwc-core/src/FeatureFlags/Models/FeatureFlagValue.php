<?php

namespace GoDaddy\WordPress\MWC\Core\FeatureFlags\Models;

use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Common\Models\AbstractModel;

/**
 * The value of a feature flag.
 */
class FeatureFlagValue extends AbstractModel
{
    /** @var bool|null */
    protected $boolValue;

    /** @var int|null */
    protected $longValue;

    /** @var float|null */
    protected $doubleValue;

    /** @var string|null */
    protected $stringValue;

    /**
     * Sets the boolean value of the feature flag.
     *
     * @param bool $value
     * @return $this
     */
    public function setBoolValue(bool $value)
    {
        $this->boolValue = $value;

        return $this;
    }

    /**
     * Gets the boolean value of the feature flag.
     *
     * @return bool|null
     */
    public function getBoolValue()
    {
        return $this->boolValue;
    }

    /**
     * Sets the boolean value of the feature flag.
     *
     * @param int $value
     * @return $this
     */
    public function setLongValue(int $value)
    {
        $this->longValue = $value;

        return $this;
    }

    /**
     * Gets the boolean value of the feature flag.
     *
     * @return int|null
     * @return $this
     */
    public function getLongValue()
    {
        return $this->longValue;
    }

    /**
     * Sets the long value of the feature flag.
     *
     * @param float $value
     * @return $this
     */
    public function setDoubleValue(float $value)
    {
        $this->doubleValue = $value;

        return $this;
    }

    /**
     * Gets the double value of the feature flag.
     *
     * @return float|null
     * @return $this
     */
    public function getDoubleValue()
    {
        return $this->doubleValue;
    }

    /**
     * Sets the string value of the feature flag.
     *
     * @param string $value
     * @return $this
     */
    public function setStringValue(string $value)
    {
        $this->stringValue = $value;

        return $this;
    }

    /**
     * Gets the boolean value of the feature flag.
     *
     * @return string|null
     * @return $this
     */
    public function getStringValue()
    {
        return $this->stringValue;
    }

    /**
     * Converts all class data properties to an array.
     *
     * @return array
     */
    public function toArray() : array
    {
        return ArrayHelper::whereNotNull(parent::toArray());
    }
}
