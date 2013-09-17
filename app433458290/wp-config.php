<?php
/** 
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information by
 * visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
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
define('DB_NAME', 'db434680540');

/** MySQL database username */
define('DB_USER', 'dbo434680540');

/** MySQL database password */
define('DB_PASSWORD', '85yNWZqS');

/** MySQL hostname */
define('DB_HOST', 'db1187.oneandone.co.uk');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link http://api.wordpress.org/secret-key/1.1/ WordPress.org secret-key service}
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '5XgYRr9@^pIV4sFZu)O!e@IlDcCGYK3ux#j)79PnjPl!kK@wF3SGNiGDN$X5*xlU');
define('SECURE_AUTH_KEY',  '@Ni)5tKuMklM#ooZVg#JvX&vq#)E2qY7Wmk5dSl&1QHiUZEXJCNWoQI1ULwT8DdL');
define('LOGGED_IN_KEY',    'qCo)m6*(e%AqERK&dbq9EGGE&pEhfd1e4oEQMj#0l91aNAcDMhm9kG1oUMJfDf$%');
define('NONCE_KEY',        'DeHvkc!ebvvOrzOurYBzR$XGwhDMJ9(P0x@5fwYvU8H8r5zx$@QKpxHcFYm6FwEP');
define('AUTH_SALT',        'YwqavSggaZBgbGa$w&v$d#QE0!eDMA2T%Sg7iH%!%oACbf75KJ@n029!mVARzvWK');
define('SECURE_AUTH_SALT', '1EqlMYNi5i6NsiSHs@hk7hhideLIIAt381xB!BKlJCKAHYl0LL@MYdKE^K2WkE(4');
define('LOGGED_IN_SALT',   'Yj0HouCPFm5#oGpor9acWTMGShHMLrY0T8s*rI$N$2%JEh6M!Aszs!&hLRusgv%p');
define('NONCE_SALT',       '9uCr2giqaqPVxTrBmPkRJ4OzRhX97GNyhGxe!IGgv*Vwn*1g*BTtdtjSsfoe8YW*');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'n4475r03ajwp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', 'en_US');

define ('FS_METHOD', 'direct');

define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

?>
