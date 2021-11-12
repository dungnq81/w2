<?php

namespace Webhd\Themes;

/**
 * Customize Class
 * @author   WEBHD
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if (!class_exists('Customizer')) {
	class Customizer
	{
		public function __construct()
		{
			// Setup the Theme Customizer settings and controls.
			add_action('customize_register', [&$this, 'register'], 30);
		}

		/**
		 * Register customizer options.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function register($wp_customize)
		{
			// logo mobile
			$wp_customize->add_setting('logo_mobile');
			$wp_customize->add_control(
				new \WP_Customize_Image_Control(
					$wp_customize,
					'logo_mobile',
					[
						'label'    => __('Mobile Logo', W_TEXTDOMAIN),
						'section'  => 'title_tagline',
						'settings' => 'logo_mobile',
						'priority' => 8,
					]
				)
			);

			// -------------------------------------------------------------
			// -------------------------------------------------------------

			// Create custom panels
			$wp_customize->add_panel(
				'addon_menu_panel',
				[
					'priority'       => 140,
					'theme_supports' => '',
					'title'          => __('HD', W_TEXTDOMAIN),
					'description'    => __('Controls the add-on menu', W_TEXTDOMAIN),
				]
			);

			// -------------------------------------------------------------
			// -------------------------------------------------------------

			// Create offcanvas section
			$wp_customize->add_section(
				'offcanvas_menu_section',
				[
					'title'    => __('offCanvas Menu', W_TEXTDOMAIN),
					'panel'    => 'addon_menu_panel',
					'priority' => 1000,
				]
			);

			// add offcanvas control
			$wp_customize->add_setting(
				'offcanvas_menu_setting',
				[
					'default'           => 'default',
					'sanitize_callback' => 'sanitize_text_field',
					'transport'         => 'refresh',
				]
			);
			$wp_customize->add_control(
				'offcanvas_menu_control',
				[
					'label'    => __('offCanvas position', W_TEXTDOMAIN),
					'type'     => 'radio',
					'section'  => 'offcanvas_menu_section',
					'settings' => 'offcanvas_menu_setting',
					'choices'  => [
						'left'    => __('Left', W_TEXTDOMAIN),
						'right'   => __('Right', W_TEXTDOMAIN),
						'top'     => __('Top', W_TEXTDOMAIN),
						'bottom'  => __('Bottom', W_TEXTDOMAIN),
						'default' => __('Default (Right)', W_TEXTDOMAIN),
					],
				]
			);

			// -------------------------------------------------------------

			// Create news section
			$wp_customize->add_section(
				'news_menu_section',
				[
					'title'    => __('News image', W_TEXTDOMAIN),
					'panel'    => 'addon_menu_panel',
					'priority' => 1001,
				]
			);

			// add news control
			$wp_customize->add_setting(
				'news_menu_setting',
				[
					'default'           => 'default',
					'sanitize_callback' => 'sanitize_text_field',
					'transport'         => 'refresh',
				]
			);
			$wp_customize->add_control(
				'news_menu_control',
				[
					'label'    => __('Image ratio', W_TEXTDOMAIN),
					'type'     => 'radio',
					'section'  => 'news_menu_section',
					'settings' => 'news_menu_setting',
					'choices'  => [
						'1v1'     => __('1:1', W_TEXTDOMAIN),
						'3v2'     => __('3:2', W_TEXTDOMAIN),
						'4v3'     => __('4:3', W_TEXTDOMAIN),
						'16v9'    => __('16:9', W_TEXTDOMAIN),
						'default' => __('Ratio default (16:9)', W_TEXTDOMAIN),
					],
				]
			);

			// -------------------------------------------------------------

			// Create product section
			$wp_customize->add_section(
				'product_menu_section',
				[
					'title'    => __('Product image', W_TEXTDOMAIN),
					'panel'    => 'addon_menu_panel',
					'priority' => 1001,
				]
			);

			// add product control
			$wp_customize->add_setting(
				'product_menu_setting',
				[
					'default'           => 'default',
					'sanitize_callback' => 'sanitize_text_field',
					'transport'         => 'refresh',
				]
			);
			$wp_customize->add_control(
				'product_menu_control',
				[
					'label'    => __('Image ratio', W_TEXTDOMAIN),
					'type'     => 'radio',
					'section'  => 'product_menu_section',
					'settings' => 'product_menu_setting',
					'choices'  => [
						'1v1'     => __('1:1', W_TEXTDOMAIN),
						'3v2'     => __('3:2', W_TEXTDOMAIN),
						'4v3'     => __('4:3', W_TEXTDOMAIN),
						'16v9'    => __('16:9', W_TEXTDOMAIN),
						'default' => __('Ratio default (3:2)', W_TEXTDOMAIN),
					],
				]
			);

			// -------------------------------------------------------------

			// Create video section
			$wp_customize->add_section(
				'video_menu_section',
				[
					'title'    => __('Video image', W_TEXTDOMAIN),
					'panel'    => 'addon_menu_panel',
					'priority' => 1002,
				]
			);

			// add news control
			$wp_customize->add_setting(
				'video_menu_setting',
				[
					'default'           => 'default',
					'sanitize_callback' => 'sanitize_text_field',
					'transport'         => 'refresh',
				]
			);
			$wp_customize->add_control(
				'video_menu_control',
				[
					'label'    => __('Image ratio', W_TEXTDOMAIN),
					'type'     => 'radio',
					'section'  => 'video_menu_section',
					'settings' => 'video_menu_setting',
					'choices'  => [
						'1v1'     => __('1:1', W_TEXTDOMAIN),
						'3v2'     => __('3:2', W_TEXTDOMAIN),
						'4v3'     => __('4:3', W_TEXTDOMAIN),
						'16v9'    => __('16:9', W_TEXTDOMAIN),
						'default' => __('Ratio default (5:3)', W_TEXTDOMAIN),
					],
				]
			);

			// -------------------------------------------------------------

			// Create custom field for social settings layout
			$wp_customize->add_section(
				'socials_menu_section',
				[
					'title'    => __('Social', W_TEXTDOMAIN),
					'panel'    => 'addon_menu_panel',
					'priority' => 1005,
				]
			);

			// Add options for facebook appid
			$wp_customize->add_setting('fb_menu_setting', ['sanitize_callback' => 'sanitize_text_field',]);
			$wp_customize->add_control(
				'fb_menu_control',
				[
					'label'       => __('Facebook AppID', W_TEXTDOMAIN),
					'section'     => 'socials_menu_section',
					'settings'    => 'fb_menu_setting',
					'type'        => 'text',
					'description' => __("You can do this at <a href='https://developers.facebook.com/apps/'>developers.facebook.com/apps</a>", W_TEXTDOMAIN),
				]
			);

			// Add options for facebook page_id
			$wp_customize->add_setting('fbpage_menu_setting', ['sanitize_callback' => 'sanitize_text_field',]);
			$wp_customize->add_control(
				'fbpage_menu_control',
				[
					'label'       => __('Facebook PageID', W_TEXTDOMAIN),
					'section'     => 'socials_menu_section',
					'settings'    => 'fbpage_menu_setting',
					'type'        => 'text',
					'description' => __("How do I find my Facebook Page ID? <a href='https://www.facebook.com/help/1503421039731588'>facebook.com/help/1503421039731588</a>", W_TEXTDOMAIN),
				]
			);

			// Zalo Appid
			$wp_customize->add_setting('zalo_menu_setting', ['sanitize_callback' => 'sanitize_text_field',]);
			$wp_customize->add_control(
				'zalo_menu_control',
				[
					'label'       => __('Zalo AppID', W_TEXTDOMAIN),
					'section'     => 'socials_menu_section',
					'settings'    => 'zalo_menu_setting',
					'type'        => 'text',
					'description' => __("You can do this at <a href='https://developers.zalo.me/docs/'>developers.zalo.me/docs/</a>", W_TEXTDOMAIN),
				]
			);

			// Zalo oaid
			$wp_customize->add_setting('zalo_oa_menu_setting', ['sanitize_callback' => 'sanitize_text_field',]);
			$wp_customize->add_control(
				'zalo_oa_menu_control',
				[
					'label'       => __('Zalo OAID', W_TEXTDOMAIN),
					'section'     => 'socials_menu_section',
					'settings'    => 'zalo_oa_menu_setting',
					'type'        => 'text',
					'description' => __("You can do this at <a href='https://oa.zalo.me/manage/oa?option=create'>oa.zalo.me/manage/oa?option=create</a>", W_TEXTDOMAIN),
				]
			);

			// -------------------------------------------------------------

			// Create hotline section
			$wp_customize->add_section(
				'hotline_menu_section',
				[
					'title'    => __('Hotline', W_TEXTDOMAIN),
					'panel'    => 'addon_menu_panel',
					'priority' => 1006,
				]
			);

			// add control
			$wp_customize->add_setting('hotline_setting', [
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'refresh'
			]);
			$wp_customize->add_control(
				'hotline_control',
				[
					'label'       => __('Hotline', W_TEXTDOMAIN),
					'section'     => 'hotline_menu_section',
					'settings'    => 'hotline_setting',
					'description' => __('Hotline number, support easier interaction on the phone', W_TEXTDOMAIN),
					'type'        => 'text',
				]
			);

			// add control
			$wp_customize->add_setting('hotline_zalo_setting', ['sanitize_callback' => 'sanitize_text_field',]);
			$wp_customize->add_control(
				'hotline_zalo_control',
				[
					'label'       => __('Zalo Hotline', W_TEXTDOMAIN),
					'section'     => 'hotline_menu_section',
					'settings'    => 'hotline_zalo_setting',
					'type'        => 'text',
					'description' => __('Zalo Hotline number, support easier interaction on the zalo', W_TEXTDOMAIN),
				]
			);

			// -------------------------------------------------------------

			// Create GPKD section
			$wp_customize->add_section(
				'GPKD_menu_section',
				[
					'title'    => __('Giấy phép kinh doanh', W_TEXTDOMAIN),
					'panel'    => 'addon_menu_panel',
					'priority' => 1006,
				]
			);

			// add control
			$wp_customize->add_setting(
				'GPKD_setting',
				[
					'sanitize_callback' => 'sanitize_text_field',
					'transport'         => 'refresh'
				]
			);
			$wp_customize->add_control(
				'GPKD_control',
				[
					'label'       => __('GPKD', W_TEXTDOMAIN),
					'section'     => 'GPKD_menu_section',
					'settings'    => 'GPKD_setting',
					'description' => __('Thông tin Giấy phép kinh doanh (nếu có)', W_TEXTDOMAIN),
					'type'        => 'text',
				]
			);

			// -------------------------------------------------------------

			// Create breadcrumbs background section
			$wp_customize->add_section(
				'breadcrumb_bg_section',
				[
					'title'    => __('Breadcrumb background', W_TEXTDOMAIN),
					'panel'    => 'addon_menu_panel',
					'priority' => 1007,
				]
			);

			// add control
			$wp_customize->add_setting('breadcrumb_bg_setting', ['transport' => 'refresh']);
			$wp_customize->add_control(
				new \WP_Customize_Image_Control(
					$wp_customize,
					'breadcrumb_bg_control',
					[
						'label'    => __('Breadcrumb background', W_TEXTDOMAIN),
						'section'  => 'breadcrumb_bg_section',
						'settings' => 'breadcrumb_bg_setting',
						'priority' => 9,
					]
				)
			);

			// -------------------------------------------------------------

			// Create footer background section
			$wp_customize->add_section(
				'footer_bg_section',
				[
					'title'    => __('Footer background', W_TEXTDOMAIN),
					'panel'    => 'addon_menu_panel',
					'priority' => 1008,
				]
			);

			// add control
			$wp_customize->add_setting('footer_bg_setting', ['transport' => 'refresh']);
			$wp_customize->add_control(
				new \WP_Customize_Image_Control(
					$wp_customize,
					'footer_bg_control',
					[
						'label'    => __('Footer background', W_TEXTDOMAIN),
						'section'  => 'footer_bg_section',
						'settings' => 'footer_bg_setting',
						'priority' => 9,
					]
				)
			);

			// -------------------------------------------------------------

			// Create footer layout section
			$wp_customize->add_section(
				'footer_layout_section',
				[
					'title'    => __('Footer layouts', W_TEXTDOMAIN),
					'panel'    => 'addon_menu_panel',
					'priority' => 1009,
				]
			);

			// add control
			$wp_customize->add_setting('footer_row_setting', ['sanitize_callback' => 'sanitize_text_field',]);
			$wp_customize->add_control(
				'footer_row_control',
				[
					'label'       => __('Footer row number', W_TEXTDOMAIN),
					'section'     => 'footer_layout_section',
					'settings'    => 'footer_row_setting',
					'type'        => 'number',
					'description' => __('Footer rows number', W_TEXTDOMAIN),
				]
			);

			// add control
			$wp_customize->add_setting('footer_col_setting', ['sanitize_callback' => 'sanitize_text_field',]);
			$wp_customize->add_control(
				'footer_col_control',
				[
					'label'       => __('Footer columns number', W_TEXTDOMAIN),
					'section'     => 'footer_layout_section',
					'settings'    => 'footer_col_setting',
					'type'        => 'number',
					'description' => __('Footer columns number', W_TEXTDOMAIN),
				]
			);
		}
	}
}
