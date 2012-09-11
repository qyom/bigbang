<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'jokemupc_bigbang');

/** MySQL database username */
define('DB_USER', 'jokemupc_bigbang');

/** MySQL database password */
define('DB_PASSWORD', 'XsDdvZt(JDvn');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/** Set WP home URL */
define('WP_HOME','http://'.$_SERVER['HTTP_HOST']);

/** Set WP Site URL */
define('WP_SITEURL','http://'.$_SERVER['HTTP_HOST']);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '# 9j@j_Z9{h]PK9)l7@J_<:0}Ln2BV1*UaZm->0>t-HOp_`#VK!R25SrK,j!~5;N');
define('SECURE_AUTH_KEY',  '-JiQKN+m:p|N^-5(F,Ja;LgG:I1L4X2W54^9K-#O+rQ3+a_-J!)/s-h|S>>,-vnb');
define('LOGGED_IN_KEY',    '0+F@Q%TIO_*q{GHKP./8HS3pw,x}S6PeqVa7-+Y*/.`:6Is+3+YF(Fes;!7VK2Dw');
define('NONCE_KEY',        'Q$G>- ,[_<SL2FWgP<zvL>~8OUSdtza[7`F1].tOS$&!(>Z|l>hiDFOnTe%KUT=2');
define('AUTH_SALT',        'Qhx>8?]69JIeyc37w)J}_i7%tvqgXYyHPG0{Z/c:k6|zPR,+<|bT?|U]fSmn2^a]');
define('SECURE_AUTH_SALT', 'x:f=3h. E<~xkN3<w(bq}7{X|$J+F;^8D=YlrPH]ZWP$HgB!~%0+^)e(#i}hNr(W');
define('LOGGED_IN_SALT',   '*0*M.CP?x] ^1-[QP`*,Mq]YW|z+w[)q=,/4lajd&{qphBTj9[CJ-;Ia|#&R>!q1');
define('NONCE_SALT',       '!Rjy+qCMt}e5?kh1qW[_DF&Zgv}+|{W`}H=ok%)yDazTaMvl;_..N-*ZZ<K9n5rZ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
