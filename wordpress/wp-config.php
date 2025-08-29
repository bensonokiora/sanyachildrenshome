<?php

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'sanyachildrenshome' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         'wdE@7!KxC{(a1WU&{ >vp7%bUX~z[tlWE+).%=n Qm1h@Q^<CJ#t&r:$YuT$=DsO' );
define( 'SECURE_AUTH_KEY',  '/cK2HtF573.Vr5AXqK5o0@doN;G+e+=`k2r`8.StMGZ=4Fg?GbSOd%]Z2BysZ?OU' );
define( 'LOGGED_IN_KEY',    'W0:Ak,u.OsB{SP,RkxKw)j dievVEM/]H1XQJB:9NqmGg|bYUD7if)!T=+K|nTA#' );
define( 'NONCE_KEY',        'S5;rR7 Rw*x}]b1YTG#Dex%]TP<6mY1<pv[Df%t-@YLJcmb?(Bn*Tl%YU1?~=?W+' );
define( 'AUTH_SALT',        '=N1F6;!j<@uPhbq<t?/z8RyBd(~UUDqer,k^@NR[H0GrH|!8|$Rk(tg707`yh<_R' );
define( 'SECURE_AUTH_SALT', ';@,ZJjO+Mq8..$p+5&o@)}qr^h.:7Axx@ry&._37yQtnoTTn9l~OG_%ARnjS<{]-' );
define( 'LOGGED_IN_SALT',   'nAOC;[WlG Ghjs{q)XY/?]zEdy@B/]8raPjJJp .W9,L1f.E(o:{N:m0g_FH.~TF' );
define( 'NONCE_SALT',       '6 /dM,#NLZa0B^d+||V{pRzNqt!PedfFY]jW yR1lVj4V}8=r!5*fNH)qXbD]Avo' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

