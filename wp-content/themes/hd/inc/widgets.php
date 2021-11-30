<?php

use Webhd\Widgets\Cf7_Widget;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( ! function_exists( '__register_widgets' ) ) {
	/**
	 * Register a widget
	 *
	 * Registers a WP_Widget widget
	 *
	 * @return void
	 */
	function __register_widgets() {
		class_exists( '\WPCF7' ) && register_widget( new Cf7_Widget );
	}

	/** */
	$widgets_block_editor_off = get_theme_mod_ssl( 'use_widgets_block_editor_setting' );
	if ($widgets_block_editor_off) {
		add_action( 'widgets_init', '__register_widgets', 10 );
	}
}