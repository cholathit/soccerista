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
define('DB_NAME', 'soccerista');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         ':_#93RiK `X{2eq)[XrZD k[_G-6VAu=L_NrHR!uxBp[nTsg2<JZohfB,j;-ThwN');
define('SECURE_AUTH_KEY',  '10S)a;%cG9[9r:{jM3krgmInF9*d5iz0W6K%MEobkiH*jV@m$z<Q6:tu){hA$);g');
define('LOGGED_IN_KEY',    'WFx|=dg?sO<)D^k^0P.]x~I7SzbTkUcM4HTVK&6J(hrMv^k4Bzx00H?7Huc,Oq;`');
define('NONCE_KEY',        '%LfT%$P$@qL|u]^[D%di<*_tql+h#(`sfc<vN_$TyQ.(<p`ym[`XglJvU6q,5U8T');
define('AUTH_SALT',        'E+E!oqo PK;Yg%3ufO,&0,aa.`uyt(Xde6}L6tZ9O*W4+JeTU/ZtsEmgl9?FG^{Q');
define('SECURE_AUTH_SALT', '/xXWb:b-,1vJ)h`<PNY==i *QnJM52_kq`hyjQL_QymS{x?$s$ SWOYX6hx4Cum}');
define('LOGGED_IN_SALT',   '{k%rgFz%KIgorAiapqZ!(Y%^DQygv+bPq;w0P;eRL%M.]x*NAEZ>- MP%dh-4v$0');
define('NONCE_SALT',       'im=Y5Tb6nhPaNH9NK5MEmfzm?t3[z^8.5)6FdLIar98b8:C~Dv3`CCQLGCCHHG(7');

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
