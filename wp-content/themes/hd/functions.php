<?php

/**
 * Theme functions and definitions
 *
 * @package hd
 */

define('INC', __DIR__ . '/inc');

// This theme requires WordPress 5.3 or later.
if (version_compare($GLOBALS['wp_version'], '5.3', '<')) {
    require INC . '/back-compat.php';
}

$theme = wp_get_theme();

defined('W_THEME_VERSION') || define('W_THEME_VERSION', $theme->get('Version'));
defined('W_TEXTDOMAIN') || define('W_TEXTDOMAIN', $theme->get('TextDomain'));
defined('W_AUTHOR') || define('W_AUTHOR', $theme->get('Author'));
defined('W_THEME_DIR') || define('W_THEME_DIR', trailingslashit(get_template_directory()));
defined('W_THEME_URI') || define('W_THEME_URI', trailingslashit(esc_url(get_template_directory_uri())));

require "vendor/autoload.php";

(new \Webhd\Themes\Theme); // Initialize theme settings.
(new \Webhd\Themes\Customizer); // Customizer additions.

if (is_admin()) {
    (new \Webhd\Themes\Admin);
} else {
    (new \Webhd\Themes\Defer);
}

if (is_search()) {
    (new \Webhd\Themes\Highlight_Search_Terms)::init();
}
