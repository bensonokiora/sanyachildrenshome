<?php
define('FORCE_SSL_ADMIN', true);
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
	$_SERVER['SSL'] = 443;
}
// define('WP_HOME', 'https://www.sanyachildrenshome.com');
// define('WP_SITEURL', 'https://www.sanyachildrenshome.com');
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
define( 'DB_PASSWORD', '@_b_e_n_b_e_n_' );

/** Database hostname */
define( 'DB_HOST', 'kedevelopers-mysql-service' );

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
define( 'AUTH_KEY',         'x5dC&s+I#%,qeqp26Be8S^I&ZY(QC3GS9;CB-!Ad}=Ym?bp32UNB!-z277kfG5C&' );
define( 'SECURE_AUTH_KEY',  '|x>L|Z2hPk_w0g;q:Q]rB4A-6gXOeh:/-/x5T#`h20 Do`RSXDXplpOS@M8Tb<t{' );
define( 'LOGGED_IN_KEY',    'LO6whW%8-J|&&z7A-(FM*sYP Dg9>iN h?,[+0[C_bT-CTxc,`(/SixXNy[$X(sC' );
define( 'NONCE_KEY',        'Q2DY[UM%et{uz)Ncb_B[A0vn?7*Id{:jpCOz2L;>o&y.:I4=wK)yaIrT|<XYE-PC' );
define( 'AUTH_SALT',        'A?>.W>]e0Wo[VTmcXtg^tZwF~k$r_mNjM9-<,w&B0D}IWPbwu[>8wOHFT7CUInRb' );
define( 'SECURE_AUTH_SALT', 'P$GpYF<;Y+PPzSWF~>h<B&Ue;YSy$n%J8[M3~)]itK8C0j@tE_$T/iLWgHwpmTVM' );
define( 'LOGGED_IN_SALT',   'T1^!*4g?kAL[L9~(q3,vvH}V38;Y C]hOt@IpOQA$q|k,Pd0Wa$e3=StsE X.o[&' );
define( 'NONCE_SALT',       'CMi>VB-Rqmn+E)(|/>L1P7}&+%-I5p?Ack=~&B(W,q|Mi2?erO$[{EIZ0Rjn?-/D' );

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

// define('DISALLOW_FILE_EDIT', true);
// define('DISALLOW_FILE_MODS', true);