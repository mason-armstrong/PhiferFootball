<?php
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
define('DB_NAME', 'phiferf1_WPWVI');

/** Database username */
define('DB_USER', 'phiferf1_WPWVI');

/** Database password */
define('DB_PASSWORD', '8K>feE2dDWU0:Cu]L');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY', '41ca54e1b9c6d10bc36f76ee4586ee7af2c0f4183ab16d150ab7579677347576');
define('SECURE_AUTH_KEY', 'daec37c908c965e9d270de9eeeef8f68bba985d704f2f0ccab9543b6c5fb1207');
define('LOGGED_IN_KEY', 'e39fecd39b98edcf8450b7ae35f1c0e08a42783ec7c4a746883f71f7d06f2775');
define('NONCE_KEY', '67cafc4cc70f96f92e1f14ee7b0e0e368433f3ab96b26d33c20ae5b0ebe3320b');
define('AUTH_SALT', 'b2fe22dd9381e77142abf5e7b61f3fba655c7f4d8592e79ffe413ff5c8fdef9d');
define('SECURE_AUTH_SALT', '9b02a68afead56d0af5a87c5c0cc477f15a0caea4877eac0fd4cd6299eb0f2c4');
define('LOGGED_IN_SALT', 'f27c23815d40a8249d38ac42434566d04d8f58aa17ad883f2798004894f88329');
define('NONCE_SALT', '7d31c1aef364e48f0dcb1edcf9f1e4709ac63529f6bc24d03ec973f5cb50d417');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'Uv5_';
define('WP_CRON_LOCK_TIMEOUT', 120);
define('AUTOSAVE_INTERVAL', 300);
define('WP_POST_REVISIONS', 5);
define('EMPTY_TRASH_DAYS', 7);
define('WP_AUTO_UPDATE_CORE', true);

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
