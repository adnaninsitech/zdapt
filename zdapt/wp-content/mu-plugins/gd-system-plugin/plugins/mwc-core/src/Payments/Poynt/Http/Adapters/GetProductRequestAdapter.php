<?php

namespace GoDaddy\WordPress\MWC\Core\Payments\Poynt\Http\Adapters;

use Exception;
use GoDaddy\WordPress\MWC\Core\Payments\Poynt\Http\AbstractProductRequest;
use GoDaddy\WordPress\MWC\Core\Payments\Poynt\Http\GetProductRequest;

/**
 * An adapter for converting the core product object to and from Poynt API GetProductRequest.
 */
class GetProductRequestAdapter extends AbstractProductRequestAdapter
{
    /**
     * Converts the source product to Poynt API GetProductRequest.
     *
     * @return AbstractProductRequest
     * @throws Exception
     */
    public function convertFromSource() : AbstractProductRequest
    {
        if (! $this->source->getRemoteId()) {
            throw new Exception('The source product must have a remote ID');
        }

        return $this->getProductRequest();
    }

    /**
     * {@inheritDoc}
     */
    protected function getProductRequest() : AbstractProductRequest
    {
        return new GetProductRequest($this->source->getRemoteId());
    }
}
