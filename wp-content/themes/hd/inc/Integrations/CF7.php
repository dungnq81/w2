<?php

namespace Webhd\Integrations;

if (!defined('ABSPATH')) exit();

// If plugin - 'WPCF7' not exist then return.
if (!class_exists('\WPCF7')) {
    return;
}

if (!class_exists('CF7')) {
    class CF7
    {
        public function __construct()
        {
            // do not need to call the plugin on pages where this very form does not exist.
            // Deregister Contact Form 7 styles
            // Deregister Contact Form 7 JavaScript files on all pages without a form
            add_action('wp_print_styles', [&$this, 'deregister_styles'], 100);
            add_action('wp_print_scripts', [&$this, 'deregister_javascript'], 100);

            // remove <p> and <br> contact form 7 plugin
            add_filter('wpcf7_autop_or_not', '__return_false');

            add_filter('wpcf7_form_tag', [&$this, 'dynamic_select_term'], 10, 1);
        }

        /**
         * @return void
         */
        public function deregister_javascript()
        {
            if (!is_page(get_theme_mod_ssl("header_contacts"))) {
                wp_deregister_script('contact-form-7');
            }
        }

        /**
         * @return void
         */
        public function deregister_styles()
        {
            if (!is_page(get_theme_mod_ssl("header_contacts"))) {
                wp_deregister_style('contact-form-7');
            }
        }

        /**
         * Dynamic Select Terms for Contact Form 7
         *
         * @usage [select name taxonomy:{$taxonomy} ...]
         * @param array $tag
         *
         * @return array $tag
         */
        public function dynamic_select_term($tag)
        {
            // Only run on select lists
            if ('select' !== $tag['type'] && ('select*' !== $tag['type'])) {
                return $tag;
            } else if (empty($tag['options'])) {
                return $tag;
            }
            $term_args = array();

            // Loop options to look for our custom options
            foreach ($tag['options'] as $option) {
                $matches = explode(':', $option);
                if (!empty($matches)) {
                    switch ($matches[0]) {
                        case 'taxonomy':
                            $term_args['taxonomy'] = $matches[1];
                            break;
                        case 'parent':
                            $term_args['parent'] = intval($matches[1]);
                            break;
                    }
                }
            }

            // Ensure we have a term arguments to work with
            if (empty($term_args)) {
                return $tag;
            }

            // Merge dynamic arguments with static arguments
            $term_args = array_merge($term_args, array(
                'hide_empty'   => false,
                'hierarchical' => 1,
            ));
            $terms     = get_terms($term_args);

            // Add terms to values
            if (!empty($terms) && !is_wp_error($term_args)) {
                foreach ($terms as $term) {
                    $tag['values'][] = $term->name;
                }
            }

            return $tag;
        }
    }
}
