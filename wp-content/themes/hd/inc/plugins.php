<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class_exists('\ACF') && (new \Webhd\Compatibility\ACF_Compatibility);
class_exists('\WPCF7') && (new \Webhd\Compatibility\CF7_Compatibility);
