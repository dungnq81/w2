<?php

/**
 * Plugin Name: W
 * Version: 0.21.11
 * Plugin URI: https://webhd.vn
 * Description: Cập nhật sau...
 * Author: NTH
 * Author URI: https://webhd.vn
 */

$url = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
$is_admin = strpos( $url, '/wp-admin/' );
if ( false === $is_admin ) {
	add_filter( 'option_active_plugins', function ( $plugins ) {
		global $url;
		return $plugins;
	});
}