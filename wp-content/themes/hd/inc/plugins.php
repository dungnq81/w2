<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Webhd\Integrations\ACF_Integration;
use Webhd\Integrations\CF7_Integration;
use Webhd\Integrations\Wpdiscuz_Integration;
use Webhd\Integrations\RankMath_Integration;

class_exists('\ACF') && (new ACF_Integration);
class_exists('\WPCF7') && (new CF7_Integration);
class_exists('\WpdiscuzCore') && (new Wpdiscuz_Integration);
class_exists('\RankMath') && (new RankMath_Integration);
