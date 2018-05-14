<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/var/www/html/wordpress/wp-content/plugins/wp-super-cache/' );
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'yoyo');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'L|`9dxMHLkl~mLt+8PJkcuC*?xXK2rP@<25~_/&EM+&mBu>?s8U6zUkwECUgiZGX');
define('SECURE_AUTH_KEY',  '47q`&%)cNyF5|`=l7w2hCM{m<VuihXVGUZ8(*~~>m0 St&cc#fDRH5Z>+/OHZ-@s');
define('LOGGED_IN_KEY',    ',h0x VB8 UTI0u}@olt ;3e+_y`(>y]^X]~.u>zV<b Jm Z,@mxSFrUCD}r^K`Ed');
define('NONCE_KEY',        '!:=Y:@^]&`Nb{H4@?97iaR*K~N> EKc@r9m+QnLX_WVm|<(?LN~E%o`B4Oc0dr5=');
define('AUTH_SALT',        'xs,A.!w@N<Nmt[Cwi&~y_~nNG~NK(<*M$-6F+>q?E~R*S>i/^>QA!Ws=$uu9WHUB');
define('SECURE_AUTH_SALT', 'TV^H5D>r lu_i,tE!JW)4h{Z*|}Xi<Rc%LKyVnB>,xbw1(p3UaA%[q;Q}j*q,off');
define('LOGGED_IN_SALT',   'XB (WpqY<bkh9/7s _t,#h+e&1D)6T)2aYP2N5(e<D*=#n)*nQr7FY[j HeSGPL ');
define('NONCE_SALT',       'NH`6,aQm5~kVD=.hxCd7r=${$3vKmnyB=BBXM!8N}=wxa{2YZo`YyapDi9w8iZI2');


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

define(‘UPLOADS’, ‘wp-content/myimages’);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');







