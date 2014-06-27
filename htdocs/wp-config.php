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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'wordpress');

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
define('AUTH_KEY',         'VW,DY%hvF?-&^zoLg20)P9a&u.uh| 2Xo@,$J_yL+`!EIa+N{,~$k+?9NfW!`D`^');
define('SECURE_AUTH_KEY',  '[<qbYqx4~Y!Tu)&zg[k|+)~<!k]TsPB>l0-UpAwLkH-jP:YZohaGub+<HE4+{Zc[');
define('LOGGED_IN_KEY',    'u[O=KrA&qs=0*pVZnal>&]Iip1N!3Yy*/.qR79.;oK+f3],,:f.3Zv![Lq.1lv#4');
define('NONCE_KEY',        'qV(cfR)L,.&tALlXHIK;#f0};Ls=tAUCMfc-M|I!NbvE(;@0<gVm,I^7aKC+M&)$');
define('AUTH_SALT',        '^Bv{jM-fLn!A|_[F-6q+=cEzA~it],FGveFT%MJmvW;8!/tAV^W2-WE hun89vr4');
define('SECURE_AUTH_SALT', 'N$8%]|R:r!9&CK|H6I-ZqLb}AUOIRjfiE2XFcn&>(-|SIg-K=c{/RVc)S%_up+Ze');
define('LOGGED_IN_SALT',   'fvIE`7qKv(}2ru47Ann!fPo#)_j_aHEx8}4L$lenVob$`]^^wkOt4v<f1~o+~[Gv');
define('NONCE_SALT',       'nJ^SUF&(N`G(vwOvW0-J)*+|ZhLgh8QVo}iRPzRB[Z~EMB3+[#3+0~+%X/p0{1_e');

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
