<?php

namespace Webhd\Plugins;

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

// If plugin - 'WPCF7' not exist then return.
if ( ! class_exists( '\WPCF7' ) ) {
	return;
}

if ( ! class_exists( 'Cf7_Plugin' ) ) {
	class Cf7_Plugin {
		public function __construct() {

			// Deregister Contact Form 7 styles
			// Deregister Contact Form 7 JavaScript files on all pages without a form
			//add_filter( 'wpcf7_load_js', '__return_false' );
			//add_filter( 'wpcf7_load_css', '__return_false' );

			// remove <p> and <br> contact form 7 plugin
			add_filter( 'wpcf7_autop_or_not', '__return_false' );

			// Lọc số điện thoại ở Việt Nam
			add_filter( 'wpcf7_is_tel', [ &$this, 'filter_vietnamese_is_tel' ], 10, 2 );

			// dynamic taxonomy select
			add_filter( 'wpcf7_form_tag', [ &$this, 'dynamic_select_term' ], 10, 1 );
		}

		/**
		 * Kiểm tra số điện thoại có 10 số của Việt Nam
		 *
		 * @param string $result
		 * @param string $tel
		 *
		 * @return string
		 */
		public function filter_vietnamese_is_tel( $result, $tel ) {
			$result = preg_match( '/^(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})$/', $tel );

			return $result;
		}

		/**
		 * Dynamic Select Terms for Contact Form 7
		 *
		 * @usage [select name taxonomy:{$taxonomy} ...]
		 * @param array $tag
		 *
		 * @return array $tag
		 */
		public function dynamic_select_term( $tag ) {

			// Only run on select lists
			if ( 'select' !== $tag['type'] && ( 'select*' !== $tag['type'] ) ) {
				return $tag;
			} else if ( empty( $tag['options'] ) ) {
				return $tag;
			}
			$term_args = [];

			// Loop options to look for our custom options
			foreach ( $tag['options'] as $option ) {
				$matches = explode( ':', $option );
				if ( ! empty( $matches ) ) {
					switch ( $matches[0] ) {
						case 'taxonomy':
							$term_args['taxonomy'] = $matches[1];
							break;
						case 'parent':
							$term_args['parent'] = intval( $matches[1] );
							break;
					}
				}
			}

			// Ensure we have a term arguments to work with
			if ( empty( $term_args ) ) {
				return $tag;
			}

			// Merge dynamic arguments with static arguments
			$term_args = array_merge( $term_args, [
				'hide_empty'   => false,
				'hierarchical' => 1,
			] );
			$terms     = get_terms( $term_args );

			// Add terms to values
			if ( ! empty( $terms ) && ! is_wp_error( $term_args ) ) {
				foreach ( $terms as $term ) {
					$tag['values'][] = $term->name;
				}
			}

			return $tag;
		}
	}
}