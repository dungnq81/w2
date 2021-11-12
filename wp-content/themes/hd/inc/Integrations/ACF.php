<?php

namespace Webhd\Integrations;

if (!defined('ABSPATH')) exit();

// If plugin - 'ACF' not exist then return.
if (!class_exists('\ACF')) {
    return;
}

if (!class_exists('ACF')) {
    class ACF
    {
        public function __construct()
        {
            add_filter('acf/fields/wysiwyg/toolbars', [&$this, 'wysiwyg_toolbars']);
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
