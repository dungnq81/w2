<?php

namespace Webhd\Integrations;

if (!defined('ABSPATH')) exit();

// If plugin - 'ACF' not exist then return.
if (!class_exists('\ACF')) {
    return;
}

if (!class_exists('ACF_Integration')) {
    class ACF_Integration
    {
        public function __construct()
        {
            $this->_localFieldsGroup();
            $this->_optionsPage();

            add_filter('acf/fields/wysiwyg/toolbars', [&$this, 'wysiwyg_toolbars']);
        }

        /**
         * @return void
         */
        private function _optionsPage()
        {
        }

        /**
         * _localFieldsGroup
         *
         * @return void
         */
        private function _localFieldsGroup()
        {
            if (!function_exists('acf_add_local_field_group'))
                return false;

            //--------------------------------------
            // Thêm ảnh thumbnail cho chuyên mục, taxonomy
            //--------------------------------------
            acf_add_local_field_group([
                'key' => 'group_5fdc116006846',
                'title' => __('Ảnh chuyên mục', W_TEXTDOMAIN),
                'fields' => [
                    [
                        'key' => 'field_5fdc11a7a7c56',
                        'label' => __('Ảnh đại diện', W_TEXTDOMAIN),
                        'name' => 'term_thumb',
                        'type' => 'image',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'return_format' => 'id',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                    ],
                ],
                'location' => [
                    [
                        [
                            'param' => 'taxonomy',
                            'operator' => '==',
                            'value' => 'category',
                        ],
                    ],
                    [
                        [
                            'param' => 'taxonomy',
                            'operator' => '==',
                            'value' => 'banner_cat',
                        ],
                    ],
                ],
                'active' => true,
                'show_in_rest' => 1,
            ]);

            //--------------------------------------
            // Thuộc tính menu item
            //--------------------------------------
            acf_add_local_field_group(array(
                'key' => 'group_618e3f6a09e18',
                'title' => __('Menu item attributes', W_TEXTDOMAIN),
                'fields' => array(
                    array(
                        'key' => 'field_618e40398f73e',
                        'label' => __('Icon Image', W_TEXTDOMAIN),
                        'name' => 'icon_image',
                        'type' => 'image',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_618e3f855921f',
                                    'operator' => '==empty',
                                ),
                            ),
                        ),
                        'return_format' => 'id',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                    ),
                    array(
                        'key' => 'field_618e3f855921f',
                        'label' => __('Icon SVG', W_TEXTDOMAIN),
                        'name' => 'icon_svg',
                        'type' => 'textarea',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_618e40398f73e',
                                    'operator' => '==empty',
                                ),
                            ),
                        ),
                        'rows' => 2,
                    ),
                    array(
                        'key' => 'field_618e41946bf9f',
                        'label' => __('Label', W_TEXTDOMAIN),
                        'name' => 'label_text',
                        'type' => 'text',
                        'instructions' => __('"New", "Hot", "Featured" ... là nhãn gắn sau tiêu đề', W_TEXTDOMAIN),
                        'required' => 0,
                        'conditional_logic' => 0,
                    ),
                    array(
                        'key' => 'field_618e612039aba',
                        'label' => __('Label Color', W_TEXTDOMAIN),
                        'name' => 'label_color',
                        'type' => 'color_picker',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_618e41946bf9f',
                                    'operator' => '!=empty',
                                ),
                            ),
                        ),
                        'enable_opacity' => 1,
                        'return_format' => 'string',
                    ),
                    array(
                        'key' => 'field_618e616c351a7',
                        'label' => __('Label Background', W_TEXTDOMAIN),
                        'name' => 'label_background',
                        'type' => 'color_picker',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_618e41946bf9f',
                                    'operator' => '!=empty',
                                ),
                            ),
                        ),
                        'enable_opacity' => 1,
                        'return_format' => 'string',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'nav_menu_item',
                            'operator' => '==',
                            'value' => 'all',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'field',
                'active' => true,
                'show_in_rest' => 0,
            ));

            return true;
        }

        /**
         * @param $toolbars
         *
         * @return mixed
         */
        public function wysiwyg_toolbars($toolbars)
        {
            // Add a new toolbar called "Minimal" - this toolbar has only 1 row of buttons
            $toolbars['Minimal']    = array();
            $toolbars['Minimal'][1] = array(
                'formatselect',
                'bold',
                'italic',
                'underline',
                'link',
                'unlink',
                'forecolor',
                'blockquote'
            );

            // remove the 'Basic' toolbar completely (if you want)
            //unset( $toolbars['Full' ] );
            //unset( $toolbars['Basic' ] );

            // return $toolbars - IMPORTANT!
            return $toolbars;
        }
    }
}
