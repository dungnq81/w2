<?php

namespace Webhd\Plugins;

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

// If plugin - 'RankMath' not exist then return.
if ( ! class_exists( '\RankMath' ) ) {
	return;
}

if ( ! class_exists( 'RankMath_Plugin' ) ) {
	class RankMath_Plugin {
		public function __construct() {
			add_action( 'after_setup_theme', [ &$this, 'after_setup_theme' ] );
			add_filter( 'rank_math/frontend/breadcrumb/args', [ &$this, 'breadcrumb_args' ] );
		}

		public function after_setup_theme() {

			// Rank Math Breadcrumb.
			add_theme_support( 'rank-math-breadcrumbs' );
		}

		/**
		 * @param $args
		 *
		 * @return string[]
		 */
		public function breadcrumb_args( $args ) {
			$args = [
				'delimiter'   => '',
				'wrap_before' => '<ol id="crumbs" class="breadcrumbs" aria-label="breadcrumbs">',
				'wrap_after'  => '</ol>',
				'before'      => '<li><span property="itemListElement" typeof="ListItem">',
				'after'       => '</span></li>',
			];

			return $args;
		}
	}
}