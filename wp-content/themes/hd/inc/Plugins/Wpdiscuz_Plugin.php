<?php

namespace Webhd\Plugins;

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

// If plugin - 'Wpdiscuz' not exist then return.
if ( ! class_exists( '\WpdiscuzCore' ) ) {
	return;
}

if ( ! class_exists( 'Wpdiscuz_Plugin' ) ) {
	class Wpdiscuz_Plugin {
		public function __construct() {
			add_action( "wp_enqueue_scripts", [ &$this, "enqueue" ], 999 );
			add_action( "get_footer", [ &$this, "footer_styles" ] );
		}

		/**
		 * Dequeue
		 */
		public function enqueue() {
			wp_dequeue_style( "wpdiscuz-frontend-css" );
			wp_dequeue_style( "wpdiscuz-combo-css" );

			wp_deregister_style( "wpdiscuz-fa" );
			wp_deregister_style( "wpdiscuz-font-awesome" );
		}

		/**
		 * @return void
		 */
		public function footer_styles() {
			if ( wp_style_is( "wpdiscuz-frontend-css", 'registered' ) ) {
				wp_enqueue_style( "wpdiscuz-frontend-css" );
			}
			if ( wp_style_is( "wpdiscuz-combo-css", 'registered' ) ) {
				wp_enqueue_style( "wpdiscuz-combo-css" );
			}
		}
	}
}