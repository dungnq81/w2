<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!function_exists('__register_menus')) {
    function __register_menus()
    {
        /**
         * Register Menus
         * @link http://codex.wordpress.org/Function_Reference/register_nav_menus#Examples
         */
        register_nav_menus(
            [
                'main-nav'   => __('Primary Menu', W_TEXTDOMAIN),
                'second-nav' => __('Secondary Menu', W_TEXTDOMAIN),
                'mobile-nav' => __('Handheld Menu', W_TEXTDOMAIN),
                'social-nav' => __('Social menu', W_TEXTDOMAIN),
                'policy-nav' => __('Privacy Policy menu', W_TEXTDOMAIN),
            ]
        );
    }

    add_action('after_setup_theme', '__register_menus', 10);
}
