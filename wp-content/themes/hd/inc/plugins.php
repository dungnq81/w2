<?php

use Webhd\Plugins\Acf_Plugin;
use Webhd\Plugins\Cf7_Plugin;
use Webhd\Plugins\Elementor_Plugin;
use Webhd\Plugins\RankMath_Plugin;
use Webhd\Plugins\Woocommerce_Plugin;
use Webhd\Plugins\Wpdiscuz_Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class_exists( '\ACF' ) && ( new Acf_Plugin );
class_exists( '\WPCF7' ) && ( new Cf7_Plugin );
class_exists( '\WpdiscuzCore' ) && ( new Wpdiscuz_Plugin );
class_exists( '\RankMath' ) && ( new RankMath_Plugin );

class_exists( '\Elementor\Plugin' ) && ( new Elementor_Plugin );
class_exists( '\WooCommerce' ) && ( new Woocommerce_Plugin );