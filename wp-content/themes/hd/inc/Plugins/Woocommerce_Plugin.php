<?php

namespace Webhd\Plugins;

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

// If plugin - 'Woocommerce' not exist then return.
if ( ! class_exists( '\WooCommerce' ) ) {
	return;
}

if ( ! class_exists( 'Woocommerce_Plugin' ) ) {
	class Woocommerce_Plugin {
	}
}