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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'shopidb' );

/** MySQL database username */
define( 'DB_USER', 'admin_shopi' );

/** MySQL database password */
define( 'DB_PASSWORD', '6789325@Al' );

/** MySQL hostname */
define( 'DB_HOST', 'teamoryx.accountsupportmysql.com' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'P_.E5q5G2<*3,-Z)/CW<v`yV|+xe9nP1{(OZ_E`|cNh_.0)+mMH*2Q$Qqh!Scq55' );
define( 'SECURE_AUTH_KEY',  'EFtHY!L4KI&`8#{,Ua/(P2& hOMjwe& Vpzw!HDT6ow<_+YGr3}J!(>37(06I*@8' );
define( 'LOGGED_IN_KEY',    'H:TFTsMS42IhiV J4wt)S~Hh7[sY0MQwUy6H]r=6=@Isgfg0GMu739B0bNA?dH91' );
define( 'NONCE_KEY',        '$Nr1Uct:NW,3x+;-JD|n17|4p-^MAOdG,s60S}q/<RyY<FLzT)EC4fpGIsQL9-,n' );
define( 'AUTH_SALT',        'nNlWMD(1=fVYT|5#I^%x:!Gia=$M-ihyn1dy*%X|vf@P!Cwjqm.)XE*[)p`L3!TS' );
define( 'SECURE_AUTH_SALT', 'x$YvAkF!+4{.RSSfmx3qlM-?BQ*eyJj#)Nv!B+iq[}3j.m<2-7UN/}RNeG5 WLyh' );
define( 'LOGGED_IN_SALT',   'q3hG :rx_}$&g~DpY=Q?[ |6s[1TLY<?10a}-GT@@=|e~8Q(26t;cCirj[L$wnpy' );
define( 'NONCE_SALT',       'uv9vlCHxyPAmo +pL615HUcnZx <E!#cMd$aNEiHWfY/E[%6P{WEg!=+1^i)WZ[x' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
