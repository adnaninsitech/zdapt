<?php

namespace GoDaddy\WordPress\MWC\Core\Events;

use GoDaddy\WordPress\MWC\Common\Content\Context\Screen;
use GoDaddy\WordPress\MWC\Common\Events\Contracts\EventBridgeEventContract;
use GoDaddy\WordPress\MWC\Common\Helpers\StringHelper;
use GoDaddy\WordPress\MWC\Common\Traits\IsEventBridgeEventTrait;

/**
 * Page view event class.
 */
class PageViewEvent implements EventBridgeEventContract
{
    use IsEventBridgeEventTrait;

    /** @var Screen the WordPress screen object */
    protected $screen;

    /**
     * Page view event constructor.
     *
     * @param Screen $screen
     */
    public function __construct(Screen $screen)
    {
        $this->resource = 'page';
        $this->action = 'view';
        $this->screen = $screen;
    }

    /**
     * Gets the data for the event.
     *
     * @return array
     */
    protected function buildInitialData() : array
    {
        $data = $this->screen->toArray();
        $data['utm_params'] = [];

        foreach ($this->getUtmParameters() as $parameter => $value) {
            $data['utm_params'][StringHelper::replaceFirst($parameter, 'utm_', '')] = $value;
        }

        return $data;
    }

    /**
     * Gets the page's UTM URL query string parameters.
     *
     * @return array
     */
    protected function getUtmParameters() : array
    {
        return array_filter($_GET, static function ($parameter) {
            return StringHelper::startsWith($parameter, 'utm_');
        }, ARRAY_FILTER_USE_KEY);
    }
}
