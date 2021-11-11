<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/** ---------------------------------------- */

if (!function_exists('safe_mailto_shortcode')) {
    /**
     * Safe mailto function
     *
     * @param array $atts
     * @return void
     */
    function safe_mailto_shortcode($atts = [])
    {
        // normalize attribute keys, lowercase
        $atts = array_change_key_case((array) $atts, CASE_LOWER);

        // override default attributes
        $a = shortcode_atts([
            'email' => 'info@webhd.vn',
            'title' => '',
            'attributes' => '',
            'class' => '',
            'id' => esc_attr(uniqid('mail-'))
        ], $atts);

        $_attr = [];
        if ($a['id']) {
            $_attr['id'] = $a['id'];
        }

        if ($a['class']) {
            $_attr['class'] = $a['class'];
        }

        if (empty($a['title'])) {
            $a['title'] = esc_attr($a['email']);
        }

        $_attr['title'] = $a['title'];

        if ($a['attributes']) {
            $a['attributes'] = array_merge($_attr, (array) $a['attributes']);
        } else {
            $a['attributes'] = $_attr;
        }

        return safe_mailto($a['email'], $a['title'], $a['attributes']);
    }

    // add shortcode
    add_shortcode('safe_mail', 'safe_mailto_shortcode');
}

/** ---------------------------------------- */

if (!function_exists('site_logo_shortcode')) {
    /**
     * @param array $atts
     *
     * @return string
     */
    function site_logo_shortcode($atts = [])
    {
        // normalize attribute keys, lowercase
        $atts = array_change_key_case((array) $atts, CASE_LOWER);
        return site_logo();
    }

    add_shortcode('site_logo', 'site_logo_shortcode');
}
