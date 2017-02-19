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
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/u951424065/public_html/staging/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'u951424065_stag');

/** MySQL database username */
define('DB_USER', 'u951424065_stag');

/** MySQL database password */
define('DB_PASSWORD', 'hardcraft2015');

/** MySQL hostname */
define('DB_HOST', 'mysql.hostinger.es');

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
define('AUTH_KEY',         '~*gsm,XN{YnCZIvyPrlD7&|^4qkE~[=yE/jxsV7]ls0.S//)&9=bd{p-i/OV7Oz4');
define('SECURE_AUTH_KEY',  '~IT%@VwbfKD(R]epdOFM,EDWJ>Sj6.o}Y@$KAjfN6kc=<5 qGGD2ns*9@e+-tzh2');
define('LOGGED_IN_KEY',    'K0W|L^|`|h$[yqIHnmN-`!fVp.CU;-(mJx{W{G!&K~uM=rgt>S0H,kobyG>SgD: ');
define('NONCE_KEY',        'Bp8u4EbPRuLnNR|0qV$^EW=+;;-o{`.9wxF]6b?NEiO8+%d748rIX)yxT$=ma!0k');
define('AUTH_SALT',        '-XId&lc1f)c5;Rd1$y-euk`2@,qe>^]7KZ0=ZxhH^1;z4hf@!ln!,t]y pZcVkd_');
define('SECURE_AUTH_SALT', 'PV2=)1VH~q=lQ549Nc|fxnK),Tv2Q.a?JwXDG2]jn i[o##woHAP3R OTJc #k|T');
define('LOGGED_IN_SALT',   '3_Pr7?kk,[fEml>u/ac;E)x%$|HNO3I&DaD9dg@)H>-X![?wNX)dfaxjy${M8(X+');
define('NONCE_SALT',       'P3T$K:gVx4BIXRH@AWdR45Snw>_c|WW6r60+RkV=P}PLk{;pShf&O4MJN!s@EFkF');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
