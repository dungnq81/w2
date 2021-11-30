<?php

namespace Webhd\Plugins\Woocommerce;

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

// If plugin - 'Woocommerce' not exist then return.
if ( ! class_exists( '\WooCommerce' ) ) {
	return;
}

if ( ! class_exists( 'Woocommerce_Plugin' ) ) {
	class Woocommerce_Plugin {
		public function __construct() {

			add_action( 'after_setup_theme', [ &$this, 'woocommerce_setup' ], 31 );
			add_action( 'woocommerce_share', [ &$this, 'woocommerce_share' ], 10 );
			add_action( 'wp_enqueue_scripts', [ &$this, 'enqueue_scripts' ], 100 );

			add_filter( 'woocommerce_breadcrumb_defaults', [ &$this, 'woocommerce_breadcrumb_defaults' ], 11, 1 );

			// Show only lowest prices in WooCommerce variable products
			add_filter( 'woocommerce_variable_sale_price_html', [ &$this, 'variation_price_format' ], 10, 2 );
			add_filter( 'woocommerce_variable_price_html', [ &$this, 'variation_price_format' ], 10, 2 );

			add_filter( 'body_class', [ &$this, 'woocommerce_body_class' ] );
		}

		/** ---------------------------------------- */

		/**
		 * @param $price
		 * @param $product
		 *
		 * @return string
		 */
		public function variation_price_format( $price, $product ) {

			// Main Price
			$prices = [ $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) ];
			$price  = $prices[0] !== $prices[1] ? sprintf( __( 'From: %1$s', 'hd' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

			// Sale Price
			$prices = [
				$product->get_variation_regular_price( 'min', true ),
				$product->get_variation_regular_price( 'max', true )
			];
			sort( $prices );
			$saleprice = $prices[0] !== $prices[1] ? sprintf( __( 'From: %1$s', 'hd' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

			if ( $price !== $saleprice ) {
				$price = '<del>' . $saleprice . $product->get_price_suffix() . '</del> <ins>' . $price . $product->get_price_suffix() . '</ins>';
			}

			return $price;
		}

		/** ---------------------------------------- */

		/**
		 * Add 'woocommerce-active' class to the body tag
		 *
		 * @param array $classes css classes applied to the body tag.
		 *
		 * @return array $classes modified to include 'woocommerce-active' class
		 */
		public function woocommerce_body_class( $classes ) {
			$classes[] = 'wc-active';

			return $classes;
		}

		/** ---------------------------------------- */
		/**
		 * @param $defaults
		 *
		 * @return array
		 */
		public function woocommerce_breadcrumb_defaults( $defaults ) {
			$defaults = [
				'delimiter'   => '',
				'wrap_before' => '<ol id="crumbs" class="breadcrumbs" aria-label="breadcrumbs">',
				'wrap_after'  => '</ol>',
				'before'      => '<li><span property="itemListElement" typeof="ListItem">',
				'after'       => '</span></li>',
				'home'        => _x( 'Home', 'breadcrumb', 'hd' ),
			];

			return $defaults;
		}


		/** ---------------------------------------- */

		/**
		 * woocommerce_share action
		 * @return void
		 */
		public function woocommerce_share() {
			get_template_part( 'template-parts/parts/sharing' );
		}

		/** ---------------------------------------- */

		/**
		 * Woocommerce setup
		 *
		 * @return void
		 */
		public function woocommerce_setup() {

			// Declare WooCommerce support.

			add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function ( $size ) {
				return [
					'width'  => 150,
					'height' => 150,
					'crop'   => 0,
				];
			} );

			// Enabling WooCommerce product gallery features (are off by default since WC 3.0.0).

			// Add support for WC features.
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );

			// Remove default WooCommerce wrappers.
			remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper' );
			remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end' );
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar' );
		}

		/** ---------------------------------------- */

		/**
		 * @return void
		 */
		public function enqueue_scripts() {

			$gutenberg_widgets_off = get_theme_mod_ssl( 'gutenberg_use_widgets_block_editor_setting' );
			$gutenberg_off         = get_theme_mod_ssl( 'use_block_editor_for_post_type_setting' );
			if ( $gutenberg_widgets_off && $gutenberg_off ) {

				// Remove WooCommerce block CSS
				wp_dequeue_style( 'wc-block-style' );
			}
		}
	}
}