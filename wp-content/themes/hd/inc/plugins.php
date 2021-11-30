<?php

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

use Webhd\Plugins\Acf_Plugin;
use Webhd\Plugins\Cf7_Plugin;
use Webhd\Plugins\RankMath_Plugin;
use Webhd\Plugins\Elementor\Elementor_Plugin;
use Webhd\Plugins\Woocommerce\Woocommerce_Plugin;

class_exists( '\ACF' ) && ( new Acf_Plugin );
class_exists( '\WPCF7' ) && ( new Cf7_Plugin );
class_exists( '\RankMath' ) && ( new RankMath_Plugin );

class_exists( '\Elementor\Plugin' ) && ( new Elementor_Plugin );
class_exists( '\WooCommerce' ) && ( new Woocommerce_Plugin );