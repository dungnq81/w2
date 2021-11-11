<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!function_exists('__register_sidebars')) {
    /**
     * Register widget area.
     *
     * @link https://codex.wordpress.org/Function_Reference/register_sidebar
     */
    function __register_sidebars()
    {
        //...
        // homepage
        register_sidebar(
            [
                'container'     => false,
                'id'            => 'w-homepage-sidebar',
                'name'          => __('W - Homepage', W_TEXTDOMAIN),
                'description'   => __('Widgets added here will appear in homepage.', W_TEXTDOMAIN),
                'before_widget' => '<div class="%2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h4 class="heading-title">',
                'after_title'   => '</h4>',
            ]
        );

        // top homeheader
        register_sidebar(
            [
                'container'     => false,
                'id'            => 'w-homeheader-sidebar',
                'name'          => __('Top Home Header', W_TEXTDOMAIN),
                'description'   => __('Widgets added here will appear in top home header.', W_TEXTDOMAIN),
                'before_widget' => '<div class="header-widgets %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<span>',
                'after_title'   => '</span>',
            ]
        );

        // top header
        register_sidebar(
            [
                'container'     => false,
                'id'            => 'w-topheader-sidebar',
                'name'          => __('TopHeader', W_TEXTDOMAIN),
                'description'   => __('Widgets added here will appear in top header.', W_TEXTDOMAIN),
                'before_widget' => '<div class="header-widgets %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<span>',
                'after_title'   => '</span>',
            ]
        );

        // header
        register_sidebar(
            [
                'container'     => false,
                'id'            => 'w-header-sidebar',
                'name'          => __('Header', W_TEXTDOMAIN),
                'description'   => __('Widgets added here will appear in header.', W_TEXTDOMAIN),
                'before_widget' => '<div class="header-widgets %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<span>',
                'after_title'   => '</span>',
            ]
        );

        // footer columns
        $footer_args = [];

        $rows    = (int) get_theme_mod_ssl('footer_row_setting');
        $regions = (int) get_theme_mod_ssl('footer_col_setting');
        for ($row = 1; $row <= $rows; $row++) {
            for ($region = 1; $region <= $regions; $region++) {
                $footer_n = $region + $regions * ($row - 1); // Defines footer sidebar ID.
                $footer   = sprintf('footer_%d', $footer_n);
                if (1 === $rows) {

                    /* translators: 1: column number */
                    $footer_region_name = sprintf(__('Footer Column %1$d', W_TEXTDOMAIN), $region);

                    /* translators: 1: column number */
                    $footer_region_description = sprintf(__('Widgets added here will appear in column %1$d of the footer.', W_TEXTDOMAIN), $region);
                } else {

                    /* translators: 1: row number, 2: column number */
                    $footer_region_name = sprintf(__('Footer Row %1$d - Column %2$d', W_TEXTDOMAIN), $row, $region);

                    /* translators: 1: column number, 2: row number */
                    $footer_region_description = sprintf(__('Widgets added here will appear in column %1$d of footer row %2$d.', W_TEXTDOMAIN), $region, $row);
                }

                $footer_args[$footer] = [
                    'name'        => $footer_region_name,
                    'id'          => sprintf('w-footer-%d', $footer_n),
                    'description' => $footer_region_description,
                ];
            }
        }

        foreach ($footer_args as $args) {
            $footer_tags = [
                'container'     => false,
                'before_widget' => '<div class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h6 class="widget-title">',
                'after_title'   => '</h6>',
            ];

            if (is_array($footer_tags)) {
                register_sidebar($args + $footer_tags);
            }
        }
    }

    /** */
    add_action('widgets_init', '__register_sidebars', 10);
}
