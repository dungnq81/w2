<?php

namespace Webhd\Widgets;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Webhd\Helpers\Str;
use WP_Widget;

abstract class Widget extends WP_Widget
{
    /**
     * @var array
     */
    protected $prefix = 'w-';

    /**
     * @var array
     */
    protected $widgetArgs;

    /**
     * __construct function
     */
    public function __construct()
    {
        $className = (new \ReflectionClass($this))->getShortName();
        $className = str_replace(['_Widget', 'Widget'], '', $className);
        $baseId = $this->prefix . Str::dashCase($className);
        parent::__construct($baseId, $this->widgetName(), $this->widgetOptions());
    }

    /**
     * @return string
     */
    protected function widgetDescription()
    {
        return '';
    }

    /**
     * @return string
     */
    protected function widgetName()
    {
        return __('Unknown Widget', W_TEXTDOMAIN);
    }

    /**
     * @return array
     */
    protected function widgetOptions()
    {
        return [
            'description' => $this->widgetDescription(),
            'name' => $this->widgetName(),
            'customize_selective_refresh' => true,
            'show_instance_in_rest' => true,
        ];
    }
}
