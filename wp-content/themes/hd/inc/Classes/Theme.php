<?php

namespace Webhd\Classes;

/**
 * Global Theme Class
 * @author   WEBHD
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!class_exists('Theme')) {
    class Theme
    {
        public function __construct()
        {
            $this->_cleanup();

            add_action('after_setup_theme', [&$this, 'after_setup_theme']);

            add_action('wp_enqueue_scripts', [&$this, 'enqueue_scripts'], 10);
            add_action('wp_enqueue_scripts', [&$this, 'non_latin_languages'], 28);
            add_action('wp_enqueue_scripts', [&$this, 'enqueue_inline_css'], 30); // After WooCommerce.

            add_filter('body_class', [&$this, 'body_classes'], 10, 1);
            add_filter('post_class', [&$this, 'post_classes'], 10, 1);
            add_filter('nav_menu_css_class', [&$this, 'nav_menu_css_class'], 10, 2);

            add_action('login_enqueue_scripts', [&$this, 'login_enqueue_script'], 30);
            add_action('enqueue_block_editor_assets', [&$this, 'block_editor_assets']);
        }

        /** ---------------------------------------- */

        /**
         * Sets up theme defaults and registers support for various WordPress features.
         *
         * Note that this function is hooked into the after_setup_theme hook, which
         * runs before the init hook. The init hook is too late for some features, such
         * as indicating support for post thumbnails.
         */
        public function after_setup_theme()
        {
            /**
             * Make theme available for translation.
             * Translations can be filed at WordPress.org.
             * See: https://translate.wordpress.org/projects/wp-themes/hello-elementor
             */
            load_theme_textdomain(W_TEXTDOMAIN, trailingslashit(WP_LANG_DIR) . 'themes/');
            load_theme_textdomain(W_TEXTDOMAIN, get_stylesheet_directory() . '/languages');
            load_theme_textdomain(W_TEXTDOMAIN, get_template_directory() . '/languages');

            // Add theme support for various features.
            add_theme_support('automatic-feed-links');
            add_theme_support('post-thumbnails');
            add_theme_support('post-formats', array('aside', 'image', 'gallery', 'video', 'quote', 'link', 'status'));
            add_theme_support('title-tag');
            add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style', 'navigation-widgets'));
            add_theme_support('customize-selective-refresh-widgets');
            add_theme_support('align-wide');
            add_theme_support('responsive-embeds');

            add_theme_support('wp-block-styles');
            add_theme_support('editor-styles');

            // This theme styles the visual editor to resemble the theme style.
            add_editor_style(get_template_directory_uri() . "/assets/css/editor-style.css");

            // Set default values for the upload media box
            update_option('image_default_align', 'center');
            update_option('image_default_size', 'large');

            /**
             * Add support for core custom logo.
             *
             * @link https://codex.wordpress.org/Theme_Logo
             */
            $logo_height = 120;
            $logo_width  = 240;

            add_theme_support(
                'custom-logo',
                apply_filters(
                    'custom_logo_args',
                    array(
                        'height'      => $logo_height,
                        'width'       => $logo_width,
                        'flex-height' => true,
                        'flex-width'  => true,
                        //'unlink-homepage-logo' => true,
                    )
                )
            );

            if (class_exists('\Webhd\Classes\Script_Loader')) {

                // Adds `async` and `defer` support for scripts registered
                // or enqueued by the theme.
                $loader = new \Webhd\Classes\Script_Loader;
                add_filter('script_loader_tag', [&$loader, 'filter_script_loader_tag'], 10, 2);
            }
        }

        /** ---------------------------------------- */

        /**
         * Launching operation cleanup.
         */
        protected function _cleanup()
        {
            // Xóa widget mặc định "Welcome to WordPress".
            remove_action('welcome_panel', 'wp_welcome_panel');

            // wp_head
            remove_action('wp_head', 'rsd_link'); // Remove the EditURI/RSD link
            remove_action('wp_head', 'wlwmanifest_link'); // Remove Windows Live Writer Manifest link
            remove_action('wp_head', 'wp_shortlink_wp_head'); // Remove the shortlink
            remove_action('wp_head', 'wp_generator'); // remove WordPress Generator
            remove_action('wp_head', 'feed_links_extra', 3); //remove comments feed.
            remove_action('wp_head', 'adjacent_posts_rel_link'); // Remove relational links for the posts adjacent to the current post.
            remove_action('wp_head', 'adjacent_posts_rel_link_wp_head'); // Remove prev and next links
            remove_action('wp_head', 'parent_post_rel_link');
            remove_action('wp_head', 'start_post_rel_link');
            remove_action('wp_head', 'index_rel_link');
            remove_action('wp_head', 'feed_links', 2);

            /**
             * Remove wp-json header from WordPress
             * Note that the REST API functionality will still be working as it used to;
             * this only removes the header code that is being inserted.
             */
            remove_action('wp_head', 'rest_output_link_wp_head');
            remove_action('wp_head', 'wp_oembed_add_discovery_links');
            remove_action('template_redirect', 'rest_output_link_header', 11, 0);
        }

        /** ---------------------------------------- */

        /**
         * Add Foundation 'is-active' class for the current menu item.
         *
         * @param $classes
         * @param $item
         *
         * @return array
         */
        public function nav_menu_css_class($classes, $item)
        {
            if (!is_array($classes)) {
                $classes = [];
            }

            // remove menu-item-type-, menu-item-object- classes
            foreach ($classes as $class) {
                if (
                    false !== strpos($class, 'menu-item-type-')
                    || false !== strpos($class, 'menu-item-object-')
                ) {
                    $classes = array_diff($classes, [$class]);
                }
            }
            if (
                1 == $item->current
                || true == $item->current_item_ancestor
                || true == $item->current_item_parent
            ) {
                $classes[] = 'is-active';
                $classes[] = 'active';
            }

            return $classes;
        }

        /** ---------------------------------------- */

        /**
         * Adds custom classes to the array of post classes.
         *
         * @param array $classes Classes for the post element.
         *
         * @return array
         */
        public function post_classes($classes)
        {
            // remove_sticky_class
            if (in_array('sticky', $classes)) {
                $classes   = array_diff($classes, ["sticky"]);
                $classes[] = 'wp-sticky';
            }

            // remove tag-, category- classes
            foreach ($classes as $class) {
                if (
                    str_contains($class, 'tag-')
                    || str_contains($class, 'category-')
                    || str_contains($class, 'video_cat-')
                    || str_contains($class, 'project_cat-')
                    || str_contains($class, 'product_cat-')
                    || str_contains($class, 'gallery_cat-')
                    || str_contains($class, 'service_cat-')
                    || str_contains($class, 'video_tag-')
                    || str_contains($class, 'project_tag-')
                    || str_contains($class, 'product_tag-')
                    || str_contains($class, 'gallery_tag-')
                    || str_contains($class, 'service_tag-')
                ) {
                    $classes = array_diff($classes, [$class]);
                }
            }

            return $classes;
        }

        /** ---------------------------------------- */

        /**
         * Adds custom classes to the array of body classes.
         *
         * @param array $classes Classes for the body element.
         *
         * @return array
         */
        public function body_classes($classes)
        {
            // Check whether we're in the customizer preview.
            if (is_customize_preview()) {
                $classes[] = 'customizer-preview';
            }

            foreach ($classes as $class) {
                if (
                    str_contains($class, 'page-template-templates')
                    || str_contains($class, 'page-template-templatespage-homepage-php')
                    || str_contains($class, 'wp-custom-logo')
                ) {
                    $classes = array_diff($classes, [$class]);
                }
            }

            // dark mode func
            //$classes[] = 'light-mode';

            return $classes;
        }

        /** ---------------------------------------- */

        /**
         * Add CSS for third-party plugins.
         * @return void
         */
        public function enqueue_inline_css()
        {
            $css = new \Webhd\Classes\CSS;

            // footer bg
            $_footer_bg = get_theme_mod_ssl('footer_bg_setting');
            if ($_footer_bg) {
                $css->set_selector('footer#colophon::before');
                $css->add_property('background-image', 'url(' . $_footer_bg . ')');
            }

            // breadcrumbs bg
            $breadcrumb_bg = get_theme_mod_ssl('breadcrumb_bg_setting');
            //...

            if ($css->css_output()) {
                wp_add_inline_style('app-style', $css->css_output());
            }
        }

        /** ---------------------------------------- */

        /**
         * Enqueue non-latin language styles
         * @return void
         */
        public function non_latin_languages()
        {
            $custom_css = $this->_get_non_latin_css();
            if ($custom_css) {
                wp_add_inline_style('app-style', $custom_css);
            }
        }

        /** ---------------------------------------- */

        /**
         * Enqueue scripts and styles.
         * @return void
         */
        public function enqueue_scripts()
        {
            // stylesheet.
            wp_enqueue_style("plugin-style", get_template_directory_uri() . '/assets/css/plugins.css', [], W_THEME_VERSION);
            wp_enqueue_style("app-style", get_template_directory_uri() . '/assets/css/app.css', ["plugin-style"], W_THEME_VERSION);

            // scripts.
            wp_enqueue_script("app", get_template_directory_uri() . "/assets/js/app.js", ["jquery"], W_THEME_VERSION, true);
            wp_script_add_data("app", "defer", true);

            // inline js
            $l10n = [
                'ajax_url' => esc_url(admin_url('admin-ajax.php')),
                'base_url'  => trailingslashit(site_url()),
                'theme_url' => trailingslashit(get_template_directory_uri()),
                'locale'    => get_f_locale(),
                'lang'      => get_lang(),
                //'domain'    => DOMAIN_CURRENT_SITE,
            ];

            wp_localize_script('jquery-core', 'HD', $l10n);

            /*extra scripts*/
            wp_enqueue_script("backtop", get_template_directory_uri() . "/assets/js/plugins/backtop.min.js", [], false, true);
            wp_enqueue_script("shares", get_template_directory_uri() . "/assets/js/plugins/shares.min.js", ["jquery"], false, true);

            /*comments*/
            if (is_singular() && comments_open() && get_option('thread_comments')) {
                wp_enqueue_script('comment-reply');
            }
        }

        /** ---------------------------------------- */

        /**
         * Gutenberg editor
         * @return void
         */
        public function block_editor_assets()
        {
            wp_enqueue_style('w-editor-style', get_template_directory_uri() . "/assets/css/editor-style.css");
        }

        /** ---------------------------------------- */

        public function login_enqueue_script()
        {
            wp_enqueue_style("login-style", get_template_directory_uri() . "/assets/css/admin.css", [], W_THEME_VERSION);
            wp_enqueue_script("login", get_template_directory_uri() . "/assets/js/login.js", ["jquery"], W_THEME_VERSION, true);

            // custom script/style
            $logo    = get_theme_file_uri("/assets/img/logo.png");
            $logo_bg = get_theme_file_uri("/assets/img/login-bg.jpg");

            $css = new \Webhd\Classes\CSS;
            if ($logo_bg) {
                $css->set_selector('body.login');
                $css->add_property('background-image', 'url(' . $logo_bg . ')');
            }
            if ($logo) {
                $css->set_selector('body.login #login h1 a');
                $css->add_property('background-image', 'url(' . $logo . ')');
            }

            if ($css->css_output()) {
                wp_add_inline_style('login-style', $css->css_output());
            }
        }

        /** ---------------------------------------- */

        /**
         * @param string $type
         *
         * @return string
         */
        private function _get_non_latin_css(string $type = 'front-end')
        {
            // Fetch site locale.
            $locale = get_bloginfo('language');

            // Define fallback fonts for non-latin languages.
            $font_family = apply_filters(
                'w_get_localized_font_family_types',
                array(
                    // Chinese Simplified (China) - Noto Sans SC.
                    'zh-CN' => array(
                        '\'PingFang SC\'',
                        '\'Helvetica Neue\'',
                        '\'Microsoft YaHei New\'',
                        '\'STHeiti Light\'',
                        'sans-serif'
                    ),

                    // Chinese Traditional (Taiwan) - Noto Sans TC.
                    'zh-TW' => array(
                        '\'PingFang TC\'',
                        '\'Helvetica Neue\'',
                        '\'Microsoft YaHei New\'',
                        '\'STHeiti Light\'',
                        'sans-serif'
                    ),

                    // Chinese (Hong Kong) - Noto Sans HK.
                    'zh-HK' => array(
                        '\'PingFang HK\'',
                        '\'Helvetica Neue\'',
                        '\'Microsoft YaHei New\'',
                        '\'STHeiti Light\'',
                        'sans-serif'
                    ),

                    // Korean.
                    'ko-KR' => array(
                        '\'Apple SD Gothic Neo\'',
                        '\'Malgun Gothic\'',
                        '\'Nanum Gothic\'',
                        'Dotum',
                        'sans-serif'
                    ),

                    // Thai.
                    'th'    => array('\'Sukhumvit Set\'', '\'Helvetica Neue\'', 'Helvetica', 'Arial', 'sans-serif'),
                )
            );

            // Return if the selected language has no fallback fonts.
            if (empty($font_family[$locale])) {
                return '';
            }

            // Define elements to apply fallback fonts to.
            $elements = apply_filters(
                'w_get_localized_font_family_elements',
                array(
                    'front-end' => array(
                        'body',
                        'input',
                        'textarea',
                        'button',
                        '.button',
                        '.faux-button',
                        '.wp-block-button__link',
                        '.wp-block-file__button',
                        '.has-drop-cap:not(:focus)::first-letter',
                        '.has-drop-cap:not(:focus)::first-letter',
                        '.entry-content .wp-block-archives',
                        '.entry-content .wp-block-categories',
                        '.entry-content .wp-block-cover-image',
                        '.entry-content .wp-block-latest-comments',
                        '.entry-content .wp-block-latest-posts',
                        '.entry-content .wp-block-pullquote',
                        '.entry-content .wp-block-quote.is-large',
                        '.entry-content .wp-block-quote.is-style-large',
                        '.entry-content .wp-block-archives *',
                        '.entry-content .wp-block-categories *',
                        '.entry-content .wp-block-latest-posts *',
                        '.entry-content .wp-block-latest-comments *',
                        '.entry-content p',
                        '.entry-content ol',
                        '.entry-content ul',
                        '.entry-content dl',
                        '.entry-content dt',
                        '.entry-content cite',
                        '.entry-content figcaption',
                        '.entry-content .wp-caption-text',
                        '.comment-content p',
                        '.comment-content ol',
                        '.comment-content ul',
                        '.comment-content dl',
                        '.comment-content dt',
                        '.comment-content cite',
                        '.comment-content figcaption',
                        '.comment-content .wp-caption-text',
                        '.widget_text p',
                        '.widget_text ol',
                        '.widget_text ul',
                        '.widget_text dl',
                        '.widget_text dt',
                        '.widget-content .rssSummary',
                        '.widget-content cite',
                        '.widget-content figcaption',
                        '.widget-content .wp-caption-text'
                    ),
                )
            );

            // Return if the specified type doesn't exist.
            if (empty($elements[$type])) {
                return '';
            }

            // Return the specified styles.
            $css = new \Webhd\Classes\CSS;

            $css->set_selector(implode(',', $elements[$type]));
            $css->add_property('font-family', implode(',', $font_family[$locale]));

            return $css->css_output();
        }
    }
}
