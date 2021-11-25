<?php

/**
 * Theme functions and definitions
 *
 * @package hd
 */

use Webhd\Themes\Theme;

const INC = __DIR__ . '/inc';

// This theme requires WordPress 5.3 or later.
if ( version_compare( $GLOBALS['wp_version'], '5.3', '<' ) ) {
	require __DIR__ . 'inc/back-compat.php';
}

$theme = wp_get_theme();

defined( 'W_THEME_VERSION' ) || define( 'W_THEME_VERSION', $theme->get( 'Version' ) );
defined( 'W_AUTHOR' ) || define( 'W_AUTHOR', $theme->get( 'Author' ) );
defined( 'W_THEME_PATH' ) || define( 'W_THEME_PATH', untrailingslashit( get_template_directory() ) );
defined( 'W_THEME_URL' ) || define( 'W_THEME_URL', untrailingslashit( esc_url( get_template_directory_uri() ) ) );

if ( ! file_exists( $composer = __DIR__ . '/vendor/autoload.php' ) ) {
	wp_die( __( 'Error locating autoloader. Please run <code>composer install</code>.', 'hd' ) );
}

require $composer;

// Initialize theme settings.
( new Theme )->init();