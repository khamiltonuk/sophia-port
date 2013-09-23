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
define('AUTH_KEY',         '}AM2ICyR_YbDn>-.y#CD6lV+JcFY)w3}+/${lBm-I;Dxpq}S= AuPB+d4#X~6zJ2');
define('SECURE_AUTH_KEY',  '4D)g@u0z`v}B035;%ed+6iB9|p49p?B~@gqCNdNjy4-{;<6_t.l>t~Uw.k-[C15:');
define('LOGGED_IN_KEY',    'I>3^^/T4W4j0l-)fgL+B30Pik0G%;IKF<ES(-^+h:Yt5<%G~~yN+xGj~G+#&L(!7');
define('NONCE_KEY',        'ke.~Jg4Zk{#f#B~49KtB$<Vja!2IZ$g<YlU50*Q!qm84m~jNi^-k<WC^Xa$nA#UB');
define('AUTH_SALT',        ']*wJTlpC/p@-=WqNrqXO Q{=0YZ$?i6F=|0QQcfi850#XV%J*apcK[]1|ZKe2<%e');
define('SECURE_AUTH_SALT', '[Br)7%fs<-Dcx.^&u_^3Ye<B870(C+^*CBNb&tI]IUQ[[7A!JKh8pjg|#Su!XwK7');
define('LOGGED_IN_SALT',   'fx>`>T<{sEY<^5a#66{Q!mc$?J;/Pd-|Z1x1BNM)3>57.QDf {fUS/`^&^fk%vX:');
define('NONCE_SALT',       '0e1[A^=n8DD8;q@@/1^z_RVJX$M*JI?p+3BThl`cq} iwfh7(NE!G YJ8{[:a`9U');

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
