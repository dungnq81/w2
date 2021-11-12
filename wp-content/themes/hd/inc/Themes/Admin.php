<?php

namespace Webhd\Themes;

/**
 * Admin Class
 * @author   WEBHD
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!class_exists('Admin')) {
    class Admin
    {
        public function __construct()
        {
            /*remove admin wp version*/
            if (!WP_DEBUG) {
                add_filter('update_footer', '__return_empty_string', 11);
            }

            add_action('admin_init', [&$this, 'admin_init'], 1);

            add_filter('admin_footer_text', [&$this, 'admin_footer_text']);
            add_action('admin_menu', [&$this, 'dashboard_meta_box']);
            add_action('admin_enqueue_scripts', [&$this, 'admin_enqueue_scripts'], 31);

            // Disables the block editor from managing widgets.
            add_filter('use_widgets_block_editor', '__return_false');

            // Disables the block editor from managing widgets in the Gutenberg plugin.
            //add_filter('gutenberg_use_widgets_block_editor', '__return_false');

            // Use Classic Editor - Disable Gutenberg Editor
            //add_filter('use_block_editor_for_post_type', '__return_false');
        }

        /** ---------------------------------------- */

        /**
         * Add admin column
         */
        public function admin_init()
        {
            // Add customize column taxonomy
            // https://wordpress.stackexchange.com/questions/77532/how-to-add-the-category-id-to-admin-page
            $taxonomy_arr = [
                'category',
                'post_tag',
                //'video_cat',
                //'video_tag',
                //'banner_cat',
                //'project_cat',
                //'project_tag',
            ];
            foreach ($taxonomy_arr as $term) {
                add_filter("{$term}_row_actions", [&$this, 'term_action_links'], 10, 2);
            }

            // customize row_actions
            $post_type_arr = [
                'user',
                'post',
                'page',
                //'project',
                //'video',
            ];
            foreach ($post_type_arr as $post_type) {
                add_filter("{$post_type}_row_actions", [&$this, 'post_type_action_links'], 10, 2);
            }

            // thumb post page
            add_filter('manage_posts_columns', [&$this, 'post_header'], 11, 1);
            add_filter('manage_posts_custom_column', [&$this, 'post_column'], 11, 2);
            add_filter('manage_pages_columns', [&$this, 'post_header'], 5, 1);
            add_filter('manage_pages_custom_column', [&$this, 'post_column'], 5, 2);

            // thumb term
            $thumb_term = [
                'category',
                //'video_cat',
                //'banner_cat',
                //'project_cat',
            ];
            foreach ($thumb_term as $term) {
                add_filter("manage_edit-{$term}_columns", [&$this, 'term_header'], 11, 1);
                add_filter("manage_{$term}_custom_column", [&$this, 'term_column'], 11, 3);
            }

            // exclude thumb post column
            $exclude_thumb_posts = [
                //'product',
                //'site-review',
                'wpcf7_contact_form',
            ];

            foreach ($exclude_thumb_posts as $post) {
                add_filter("manage_{$post}_posts_columns", [$this, 'post_exclude_header'], 12, 1);
            }
        }

        /** ---------------------------------------- */
        /** ---------------------------------------- */

        /**
         * @param $columns
         *
         * @return mixed
         */
        public function post_exclude_header($columns)
        {
            unset($columns['post_thumb']);
            return $columns;
        }

        /** ---------------------------------------- */

        /**
         * @param string $out
         * @param string $column
         * @param int $term_id
         * @return void|string
         */
        public function term_column($out, $column, $term_id)
        {
            switch ($column) {
                case 'term_thumb':
                    $term_thumb = acf_term_thumb($term_id, $column, "thumbnail", true);
                    if (!$term_thumb) {
                        $term_thumb = placeholder_src();
                    }

                    return $out = $term_thumb;
                    break;

                default:
                    return $out;
                    break;
            }
        }

        /** ---------------------------------------- */

        /**
         * @param $columns
         *
         * @return array
         */
        public function term_header($columns)
        {
            $in = [
                "term_thumb" => sprintf('<span class="wc-image tips">%1$s</span>', __("Thumb", W_TEXTDOMAIN)),
            ];

            $columns = array_push_after($columns, $in, 0);
            return $columns;
        }

        /** ---------------------------------------- */

        /**
         * @param $name
         * @param $id
         */
        public function post_column($column_name, $post_id)
        {
            switch ($column_name) {
                case 'post_thumb':
                    $post_type = get_post_type($post_id);
                    if (!in_array($post_type, ['video', 'product'])) {
                        if (!$thumbnail = get_the_post_thumbnail($post_id, 'thumbnail')) {
                            $thumbnail = placeholder_src();
                        }

                        echo $thumbnail;
                    } else if ('video' == $post_type) {
                        if (has_post_thumbnail($post_id)) {
                            echo get_the_post_thumbnail($post_id, 'thumbnail');
                        } else if (function_exists('get_field') && $url = get_field('url', $post_id)) {
                            $img_src = youtube_image(esc_url($url), ['default']);
                            echo "<img alt=\"\" src=\"" . $img_src . "\" />";
                        }
                    }

                    break;
            }
        }

        /** ---------------------------------------- */

        /**
         * @param $columns
         *
         * @return array
         */
        public function post_header($columns)
        {
            $in = [
                "post_thumb" => sprintf('<span class="wc-image tips">%1$s</span>', __("Thumb", W_TEXTDOMAIN)),
            ];

            $columns = array_push_after($columns, $in, 0);
            return $columns;
        }

        /** ---------------------------------------- */

        /**
         * @param $actions
         * @param $_object
         *
         * @return mixed
         */
        public function post_type_action_links($actions, $_object)
        {
            if (!in_array($_object->post_type, ['product', 'site-review'])) {
                array_unshift_assoc($actions, 'action_id', 'Id:' . $_object->ID);
            }

            return $actions;
        }

        /** ---------------------------------------- */

        /**
         * @param $actions
         * @param $_object
         *
         * @return mixed
         */
        public function term_action_links($actions, $_object)
        {
            array_unshift_assoc($actions, 'action_id', 'Id: ' . $_object->term_id);
            return $actions;
        }

        /** ---------------------------------------- */

        /**
         * @return void
         */
        public function admin_enqueue_scripts()
        {
            wp_enqueue_style("admin-style", get_template_directory_uri() . "/assets/css/admin.css", [], W_THEME_VERSION);
            wp_enqueue_script("admin", get_template_directory_uri() . "/assets/js/admin.js", ["jquery"], W_THEME_VERSION, true);
        }

        /** ---------------------------------------- */

        /**
         * Remove dashboard widgets
         *
         * @return void
         */
        public function dashboard_meta_box()
        {
            /*Incoming Links Widget*/
            //remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');

            /*Remove WordPress Events and News*/
            remove_meta_box('dashboard_primary', 'dashboard', 'normal');
        }

        /** ---------------------------------------- */

        public function admin_footer_text()
        {
            printf('<span id="footer-thankyou">%1$s <a href="https://webhd.vn/" target="_blank">%2$s</a>.&nbsp;</span>', __('Powered by', W_TEXTDOMAIN), W_AUTHOR);
        }
    }
}
