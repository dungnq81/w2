<?php

namespace Webhd\Classes;

/**
 * Deferred Class
 * @author   WEBHD
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if (!class_exists('Defer')) {
	class Defer
	{
		/**
		 * Defer constructor.
		 */
		public function __construct()
		{
			add_action('wp_footer', [&$this, 'deferred_scripts'], 1000);
		}

		/**
		 * @return void
		 */
		public function deferred_scripts()
		{
			// Facebook
			$fb_appid  = get_theme_mod_ssl('fb_menu_setting');
			$fb_pageid = get_theme_mod_ssl('fbpage_menu_setting');
			$fb_locale = get_f_locale();

			if ($fb_appid && !is_customize_preview()) {
				echo "\n";
				echo "<script>";
				echo "window.fbAsyncInit = function() {FB.init({appId:'" . $fb_appid . "',status:true,xfbml:true,autoLogAppEvents:true,version:'v11.0'});};";
				echo "</script>";
				echo "<script async defer crossorigin=\"anonymous\" data-type='lazy' data-src=\"https://connect.facebook.net/" . $fb_locale . "/sdk.js\"></script>";
				if ($fb_pageid) {
					echo '<script async defer data-type="lazy" data-src="https://connect.facebook.net/' . $fb_locale . '/sdk/xfbml.customerchat.js"></script>';
					$_fb_message = __('If you need assistance, please leave a message here. Thanks', W_TEXTDOMAIN);
					echo '<div class="fb-customerchat" attribution="setup_tool" page_id="' . $fb_pageid . '" theme_color="#CC3366" logged_in_greeting="' . esc_attr($_fb_message) . '" logged_out_greeting="' . esc_attr($_fb_message) . '"></div>';
				}
			}

			// Zalo
			$zalo_oaid    = get_theme_mod_ssl('zalo_oa_menu_setting');
			if ($zalo_oaid) {
				echo '<div class="zalo-chat-widget" data-oaid="' . $zalo_oaid . '" data-welcome-message="' . __('Rất vui khi được hỗ trợ bạn.', W_TEXTDOMAIN) . '" data-autopopup="0" data-width="350" data-height="420"></div>';
				echo "<script defer data-type='lazy' data-src=\"https://sp.zalo.me/plugins/sdk.js\"></script>";
			}

			/***Set delay timeout milisecond***/
			$timeout = 5000;
			$inline_js = 'const loadScriptsTimer=setTimeout(loadScripts,' . $timeout . ');const userInteractionEvents=["mouseover","keydown","touchstart","touchmove","wheel"];userInteractionEvents.forEach(function(event){window.addEventListener(event,triggerScriptLoader,{passive:!0})});function triggerScriptLoader(){loadScripts();clearTimeout(loadScriptsTimer);userInteractionEvents.forEach(function(event){window.removeEventListener(event,triggerScriptLoader,{passive:!0})})}';
			$inline_js .= "function loadScripts(){document.querySelectorAll(\"script[data-type='lazy']\").forEach(function(elem){elem.setAttribute(\"src\",elem.getAttribute(\"data-src\"));elem.removeAttribute(\"data-src\");})}";
			echo '<script src="data:text/javascript;base64,' . base64_encode($inline_js) . '"></script>';
			echo "\n";
		}
	}
}
