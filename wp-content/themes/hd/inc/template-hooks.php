<?php

/**
 * Template Filters
 * @author   WEBHD
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

use Webhd\Helpers\Cast;

// ------------------------------------------------------

// wp_head
add_action('wp_head', '__extra_header', 10);
function __extra_header()
{
	//echo "<meta name=\"theme-color\" content=\"#00B38F\" />";
	//echo '<link rel="preconnect" href="https://fonts.gstatic.com">';
	//echo "<link rel=\"manifest\" href=\"/manifest.json\">";
	//echo "\n";

	$fb_appid = get_theme_mod_ssl('fb_menu_setting');
	if ($fb_appid) {
		echo '<meta property="fb:app_id" content="' . $fb_appid . '" />';
	}
	echo "\n";
}

// ------------------------------------------------------

// wp_footer
add_action('wp_footer', '__extra_footer', 99);
function __extra_footer()
{
}

// ------------------------------------------------------

add_action('off_canvas', '__off_canvas_button', 10);
function __off_canvas_button()
{
	// mobile navigation
	$position = get_theme_mod_ssl('offcanvas_menu_setting');
	if ('right' == $position) {
		get_template_part('template-parts/header/navigation-right-offcanvas');
	} elseif ('top' == $position) {
		get_template_part('template-parts/header/navigation-top-offcanvas');
	} elseif ('bottom' == $position) {
		get_template_part('template-parts/header/navigation-bottom-offcanvas');
	} else {
		get_template_part('template-parts/header/navigation-left-offcanvas');
	}
}

// ------------------------------------------------------

// header
add_action('header', '__topheader', 10);
add_action('header', '__header', 10);

function __topheader()
{
	$topheader = is_active_sidebar('topheader-sidebar');
}

function __header()
{
	$header = is_active_sidebar('header-sidebar');
}

// ------------------------------------------------------

// footer
add_action('footer', '__footer_widgets', 10);
add_action('footer', '__footer_credit', 11);

function __footer_widgets()
{
	$rows    = Cast::toInt(get_theme_mod_ssl('footer_row_setting'));
	$regions = Cast::toInt(get_theme_mod_ssl('footer_col_setting'));
}

function __footer_credit()
{
}

// ------------------------------------------------------

// before footer
add_action('before_footer', '__before_footer_extra', 31);
function __before_footer_extra()
{
}

// ------------------------------------------------------

// before content
add_action('before_content', '__before_content_extra', 10);
function __before_content_extra()
{
}

// ------------------------------------------------------
// ------------------------------------------------------

/**
 * @param $item_output
 * @param $item
 * @param $depth
 * @param $args
 *
 * @return string|string[]
 */
add_filter('walker_nav_menu_start_el', function ($item_output, $item, $depth, $args) {

	// Change SVG icon inside social links menu if there is supported URL.
	if ('social-nav' === $args->theme_location && class_exists('\Webhd\Themes\SVG_Icons')) {
		$svg = \Webhd\Themes\SVG_Icons::get_social_link_svg($item->url, 24);
		if (!empty($svg)) {
			$item_output = str_replace($args->link_before, $svg, $item_output);
		}
	}
	return $item_output;
}, 10, 4);

// -------------------------------------------------------------

/**
 * @param array $args
 *
 * @return array
 */
add_filter('widget_tag_cloud_args', function (array $args) {
	$args['smallest'] = '10';
	$args['largest']  = '19';
	$args['unit']     = 'px';
	$args['number']   = 12;

	return $args;
});

// -------------------------------------------------------------

// add class to achor link
add_filter('nav_menu_link_attributes', function ($atts) {
	//$atts['class'] = "nav-link";
	return $atts;
}, 100, 1);
