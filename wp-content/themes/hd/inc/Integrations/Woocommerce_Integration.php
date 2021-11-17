<?php

namespace Webhd\Integrations;

if (!defined('ABSPATH')) exit();

// If plugin - 'Woocommerce' not exist then return.
if (!class_exists('\WooCommerce')) {
    return;
}

if (!class_exists('Woocommerce_Integration')) {
    class Woocommerce_Integration
    {
    }
}
