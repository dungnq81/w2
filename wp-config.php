<?php

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

/** PHP Memory */
const WP_MEMORY_LIMIT     = '512';
const WP_MAX_MEMORY_LIMIT = '512';

const DISALLOW_FILE_MODS = false;

const WP_POST_REVISIONS = 1;
const EMPTY_TRASH_DAYS  = 5;
const AUTOSAVE_INTERVAL = 120;

/** Disable WordPress core auto-update, */
const WP_AUTO_UPDATE_CORE = false;

// ** MySQL settings - You can get this info from your web host ** //
const DB_NAME     = 'w2';
const DB_USER     = 'root';
const DB_PASSWORD = 'root';
const DB_HOST     = 'localhost';
const DB_CHARSET  = 'utf8mb4';
const DB_COLLATE  = '';

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY', '_n>$/Yb$q[T2VnP.L5G*Z6p)r>L`*M/_NK0RjUM1o @7wv/bH|0@8Q_hbtOQ7|_x' );
define( 'SECURE_AUTH_KEY', 'cQJ5y3v2{wl;0,w=k~F$AE)k9qt`wu^LkfzX41j_)q}@)c-s?fziVt v>3x^Yliw' );
define( 'LOGGED_IN_KEY', '(sxVzn.QY6oa6Cg3<)^sev;gl=,>~mwBO]7(`wfH&Lv-Gog9@)H/WJ@Y@evTu*ud' );
define( 'NONCE_KEY', 'dr_:kdzbIr2t<h(^ntHhOIS#m=^ UGx#rw^Bsp=Vh?<?n?k2vHoTZw]7s+.STJ!p' );
define( 'AUTH_SALT', '05kpfk4i7rQ<mPO?0@3zC8f(k?/ojh)AU(&;E^p=jc{_O8`-+jC<|cCihp2nyasb' );
define( 'SECURE_AUTH_SALT', '<TXYvd8!h07L]f0D:S6ky5Z2X4{dZOB-IVH,|a6V92s#)o#iv}p91.q-.]!kouq~' );
define( 'LOGGED_IN_SALT', ']us`+il(VNEA1$S{}[>JAW$F2ru1P%+kd`W,NBg)a2k1PwH)7bQ8F](#1R^0_RW_' );
define( 'NONCE_SALT', 'e~FG7RTY8snnQ ]sWe/~#d5!;1ay=`kY|)=96x/e{&! GDqid}P?1R(ym3Sq>sSR' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'w_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
const WP_DEBUG = true;

/* Add any custom values between this line and the "stop editing" line. */


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';