<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Webhd\Widgets\Cf7_Widget;

if (!function_exists('__register_widgets')) {
    /**
     * Register a widget
     *
     * Registers a WP_Widget widget
     *
     * @return void
     */
    function __register_widgets()
    {
        register_widget(new Cf7_Widget);
    }

    /** */
    add_action('widgets_init', '__register_widgets', 10);
}
