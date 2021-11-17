<?php

namespace Webhd\Integrations;

if (!defined('ABSPATH')) exit();

// If plugin - 'Elementor' not exist then return.
if (!class_exists('\Elementor\Plugin')) {
    return;
}

if (!class_exists('Elementor_Integration')) {
    class Elementor_Integration
    {
    }
}
