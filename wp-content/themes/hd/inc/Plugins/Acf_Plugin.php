<?php

namespace Webhd\Plugins;

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

// If plugin - 'ACF' not exist then return.
if ( ! class_exists( '\ACF' ) ) {
	return;
}

if ( ! class_exists( 'Acf_Plugin' ) ) {
	class Acf_Plugin {
		public function __construct() {
			$this->_localFieldsGroup();
			$this->_optionsPage();

			add_filter( 'acf/fields/wysiwyg/toolbars', [ &$this, 'wysiwyg_toolbars' ] );
		}

		/**
		 * @param $toolbars
		 *
		 * @return mixed
		 */
		public function wysiwyg_toolbars( $toolbars ) {
			// Add a new toolbar called "Minimal" - this toolbar has only 1 row of buttons
			$toolbars['Minimal']    = [];
			$toolbars['Minimal'][1] = [
				'formatselect',
				'bold',
				'italic',
				'underline',
				'link',
				'unlink',
				'forecolor',
				//'blockquote'
			];

			// remove the 'Basic' toolbar completely (if you want)
			//unset( $toolbars['Full' ] );
			//unset( $toolbars['Basic' ] );

			// return $toolbars - IMPORTANT!
			return $toolbars;
		}

		/**
		 * @return void
		 */
		private function _optionsPage() {
		}

		/**
		 * @return bool
		 */
		private function _localFieldsGroup() {
			if ( ! function_exists( 'acf_add_local_field_group' ) ) {
				return false;
			}

			//--------------------------------------
			// Các thuộc tính chung của chuyên mục
			// gồm thứ tự và ảnh đại diện
			//--------------------------------------
			acf_add_local_field_group( [
				'key'          => 'group_5fdc116006846',
				//'title'        => __( 'Attributes', 'hd' ),
				'fields'       => [
					[
						'key'               => 'field_5fdc11a7a7c56',
						'label'             => __( 'Thumbnail', 'hd' ),
						'name'              => 'term_thumb',
						'type'              => 'image',
						'required'          => 0,
						'return_format'     => 'id',
						'preview_size'      => 'thumbnail',
						'library'           => 'all',
					],
					[
						'key'               => 'field_6194ac46987f7',
						'label'             => __( 'Menu order', 'hd' ),
						'name'              => 'term_order',
						'type'              => 'number',
						'required'          => 0,
						'default_value'     => 0,
						'min'               => '',
						'max'               => '',
					],
				],
				'location'     => [
					[
						[
							'param'    => 'taxonomy',
							'operator' => '==',
							'value'    => 'category',
						],
					],
					[
						[
							'param'    => 'taxonomy',
							'operator' => '==',
							'value'    => 'banner_cat',
						],
					],
				],
				'menu_order'   => 0,
				'instruction_placement' => 'field',
				'active'       => true,
				'show_in_rest' => 1,
			] );

			//--------------------------------------
			// Kiểu hiển thị chuyên mục
			//--------------------------------------
			acf_add_local_field_group( [
				'key'                   => 'group_619f4ab590bc9',
				//'title'                 => 'Kiểu hiển thị chuyên mục',
				'fields'                => [
					[
						'key'               => 'field_619f4ad9072ab',
						'label'             => __( 'Kiểu hiển thị', 'hd' ),
						'name'              => 'display_type',
						'type'              => 'select',
						'required'          => 0,
						'choices'           => [
							'items'         => __( 'Bài viết', 'hd' ),
							'subcategories' => __( 'Chuyên mục con', 'hd' ),
							'both'          => __( 'Cả hai', 'hd' ),
						],
						'default_value'     => 'items',
						'allow_null'        => 0,
						'multiple'          => 0,
						'ui'                => 0,
						'return_format'     => 'value',
						'ajax'              => 0,
					],
				],
				'location'              => [
					[
						[
							'param'    => 'taxonomy',
							'operator' => '==',
							'value'    => 'category',
						],
					],
				],
				'menu_order'            => 0,
				'instruction_placement' => 'field',
				'active'                => true,
				'show_in_rest'          => 1,
			] );

			//--------------------------------------
			// Thuộc tính menu item
			// Thêm icon, ảnh, nhãn...
			//--------------------------------------
			acf_add_local_field_group( [
				'key'                   => 'group_618e3f6a09e18',
				//'title'                 => __( 'Menu item attributes', 'hd' ),
				'fields'                => [
					[
						'key'               => 'field_618e40398f73e',
						'label'             => __( 'Icon Image', 'hd' ),
						'name'              => 'icon_image',
						'type'              => 'image',
						'required'          => 0,
						'conditional_logic' => [
							[
								[
									'field'    => 'field_618e3f855921f',
									'operator' => '==empty',
								],
							],
						],
						'return_format'     => 'id',
						'preview_size'      => 'thumbnail',
						'library'           => 'all',
					],
					[
						'key'               => 'field_618e3f855921f',
						'label'             => __( 'Icon SVG', 'hd' ),
						'name'              => 'icon_svg',
						'type'              => 'textarea',
						'required'          => 0,
						'conditional_logic' => [
							[
								[
									'field'    => 'field_618e40398f73e',
									'operator' => '==empty',
								],
							],
						],
						'rows'              => 2,
					],
					[
						'key'               => 'field_618e41946bf9f',
						'label'             => __( 'Label', 'hd' ),
						'name'              => 'label_text',
						'type'              => 'text',
						'instructions'      => __( '"New", "Hot", "Featured" ... là nhãn gắn sau tiêu đề', 'hd' ),
						'required'          => 0,
						'conditional_logic' => 0,
					],
					[
						'key'               => 'field_618e612039aba',
						'label'             => __( 'Label Color', 'hd' ),
						'name'              => 'label_color',
						'type'              => 'color_picker',
						'required'          => 0,
						'conditional_logic' => [
							[
								[
									'field'    => 'field_618e41946bf9f',
									'operator' => '!=empty',
								],
							],
						],
						'enable_opacity'    => 1,
						'return_format'     => 'string',
					],
					[
						'key'               => 'field_618e616c351a7',
						'label'             => __( 'Label Background', 'hd' ),
						'name'              => 'label_background',
						'type'              => 'color_picker',
						'required'          => 0,
						'conditional_logic' => [
							[
								[
									'field'    => 'field_618e41946bf9f',
									'operator' => '!=empty',
								],
							],
						],
						'enable_opacity'    => 1,
						'return_format'     => 'string',
					],
				],
				'location'              => [
					[
						[
							'param'    => 'nav_menu_item',
							'operator' => '==',
							'value'    => 'all',
						],
					],
				],
				'menu_order'            => 0,
				'instruction_placement' => 'field',
				'active'                => true,
				'show_in_rest'          => 1,
			] );

			return true;
		}
	}
}