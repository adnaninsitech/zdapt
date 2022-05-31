<?php

namespace GoDaddy\WordPress\MWC\Core\FeatureFlags\Models;

use GoDaddy\WordPress\MWC\Common\Models\AbstractModel;

/**
 * A feature flag.
 */
class FeatureFlag extends AbstractModel
{
    /** @var string|null */
    protected $id;

    /** @var FeatureFlag|null */
    protected $value;

    /**
     * Sets the ID of the feature flag.
     *
     * @param string $id
     * @return $this
     */
    public function setId(string $value)
    {
        $this->id = $value;

        return $this;
    }

    /**
     * Gets the ID of the feature flag.
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of the feature flag.
     *
     * @param FeatureFlagValue $id
     * @return $this
     */
    public function setValue(FeatureFlagValue $value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Gets the value of the feature flag.
     *
     * @return FeatureFlagValue|null
     */
    public function getValue()
    {
        return $this->value;
    }
}
