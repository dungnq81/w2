<?php

/**
 * Theme functions and definitions
 *
 * @package hd
 */

require "vendor/autoload.php";

define('INC', __DIR__ . '/inc');
$theme = wp_get_theme();

defined('W_THEME_VERSION') || define('W_THEME_VERSION', $theme->get('Version'));
defined('W_TEXTDOMAIN') || define('W_TEXTDOMAIN', $theme->get('TextDomain'));
defined('W_AUTHOR') || define('W_AUTHOR', $theme->get('Author'));

defined('W_THEME_DIR') || define('W_THEME_DIR', trailingslashit(get_template_directory()));
defined('W_THEME_URI') || define('W_THEME_URI', trailingslashit(esc_url(get_template_directory_uri())));
