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
define( 'DB_NAME', 'phiferf1_WPWVI' );

/** MySQL database username */
define( 'DB_USER', 'phiferf1_WPWVI' );

/** MySQL database password */
define( 'DB_PASSWORD', '8K>feE2dDWU0:Cu]L' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'vGc[v9t7y%1Oj_+iUNeiRrt*OqRO)(K@b7`Ce:(nxQ8{7Ud+jd@=m|Zk3Q5ehyH>' );
define( 'SECURE_AUTH_KEY',   'Gk%+z|*.Z{lTZg6?l xy,;ShJ>%?xAMuU{Yx#[xWu6=2|s2`7G<n`(xJ| k/8]DD' );
define( 'LOGGED_IN_KEY',     'UAE1N{L})<,ZW<&V^pAluHVeR</1BJ70UWdL,Won/N4sL1&UvzSAwh=xmX`^!dVm' );
define( 'NONCE_KEY',         'B+M]*.gW&FL_p=:xIOFQk;ef%~c~P,=sfti.};/no0^0IZlz@ru.PX9A36j*)}M7' );
define( 'AUTH_SALT',         'S.6sXE^MyIyQ-x/9N_zw:+z&]-1.o@Gs8{tJ]#DZ6|-%p{bN9mBY.w0f$H1rD#%@' );
define( 'SECURE_AUTH_SALT',  'h1Un(zf@/P`,eyOcckL?3?_S d@F dS~K&%!f<8unCx_r<|I|J$$hH!+Q-n@ecdI' );
define( 'LOGGED_IN_SALT',    'npQX5j~}0W?H2rkrZHe<N.B]&8mKqt*6Wl@]3Ue8n_sJLbiPMHS/R `*Ckg%p9k:' );
define( 'NONCE_SALT',        '.&|ylJ:NV(oDV=p-d3>zp>,LK]wA6?7fZx4fh`@JU/XXZupFUC&nB<2}/UPQ|=@r' );
define( 'WP_CACHE_KEY_SALT', 'K,5Y]?h;1<qF6`)4?Hbx:HL-@S|TcVv;JPp=I>v MPe+:u[RtvM~*/ A?|7L]I*B' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'staging_Uv5_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
