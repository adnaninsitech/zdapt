<?php
define( 'WP_CACHE', true );





/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'insixkif_zdapt' );

/** Database username */
define( 'DB_USER', 'insixkif_zdapt' );

/** Database password */
define( 'DB_PASSWORD', 'kf0~E6lo5w$U' );

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
define( 'AUTH_KEY',         'k!~v&Jmr7e4fVH}6XupG2Y`k/4LEyiugDP$DAR^31=|]%/cY#/3`Qt,@!0XqJi*o' );
define( 'SECURE_AUTH_KEY',  '|u7+T:/{!RDW>Pa^t~B~<iu?7bY1fw_;1UkD?^A^rq[)LlnH>WdWJaWILk/cpol0' );
define( 'LOGGED_IN_KEY',    ',nuD_M($&~RwAjPr5j=5CO )3E(*@K$r$T`14T%&0rL{C{cX`(jh(ht);:SOC!u0' );
define( 'NONCE_KEY',        'kk>UfRT+?GdqkRiQ-:|PK_tMJ+eYUASOz|_=(>Hu^ dxn*k?mcahZ#p^N17Eg`FU' );
define( 'AUTH_SALT',        '(QZQuOkv*hVzN4&)@>%Fk4@yMUo~sBXZ)g;{,;EydcnHE;LrRGN>=_R9|#7%_+n8' );
define( 'SECURE_AUTH_SALT', 'a:)X5aRDJiMexg|PYRug62?2b,;LAG88 O`_y#v@~%<c[^<jn^J8HZ,CeJ*+?;Rt' );
define( 'LOGGED_IN_SALT',   'X/k(fy`T7N/&WI]zg4)Y.(>o)6NP9J*T5Wy`@[Ao]%ns!%O8I0Mf[$p^O*.QTW.]' );
define( 'NONCE_SALT',       '1+qs$peiOD/g;pX(S)*V0Rz-=G5mg&w/sHGUGIA!98dR$y@*BhF(e.ej*Pb[.=Iw' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'zt_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
