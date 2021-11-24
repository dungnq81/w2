<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class_exists('\ACF') && (new \Webhd\Integrations\Acf_Integration);
class_exists('\WPCF7') && (new \Webhd\Integrations\Cf7_Integration);
class_exists('\WpdiscuzCore') && (new \Webhd\Integrations\Wpdiscuz_Integration);
class_exists('\RankMath') && (new \Webhd\Integrations\RankMath_Integration);

class_exists('\Elementor\Plugin') && (new \Webhd\Integrations\Elementor_Integration);
class_exists('\WooCommerce') && (new \Webhd\Integrations\Woocommerce_Integration);