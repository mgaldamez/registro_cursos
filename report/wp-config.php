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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'fieurdel_db');

/** MySQL database username */
define('DB_USER', 'fieurdel_user');

/** MySQL database password */
define('DB_PASSWORD', 'fierenze305');

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
define('AUTH_KEY',         'fhCyxrv0leM^6p+hJD07}a::hfSoBk-&RD; PE Kw6n|H:DrV^Dv=@;8lhi0h;U$');
define('SECURE_AUTH_KEY',  'cF2|BHFA/pKwgqEfVl6uM7(#xu/z{=lW2:@+GAZ ZLjBcSOUn)yu?F;[Dd;OOAsr');
define('LOGGED_IN_KEY',    'e(?g9u0EkslIx#y]C{VN#g,@LgzJ6DAsBC$PHx`755pTXSq*oLH&Rg^(CF&%;FoH');
define('NONCE_KEY',        's=ULs]~YMGO*hJ,*e^SLd&?YTWI`%}uF)bbG}f/j-(rj.G,q0C%,8VO;oPNI9%E3');
define('AUTH_SALT',        '6;te7]|HA*m8=&[1CeX]6k#q8 2-gas3#If0Ya4jVqfxT$~&f*rC4pH*c;~?H*Zr');
define('SECURE_AUTH_SALT', 'etQ.8mqfSDe@X.Xz,w%pw/D0nRMC70IhL:] Epl%7.B^~]`!bgN(u{hjmIq$3](y');
define('LOGGED_IN_SALT',   '|(nG-(|XV7XqEyL,2o0/:3RZ+P>Ad(H#%:Q{qzQe~.-GXc9L$B]9I&Q0jQa3T@E9');
define('NONCE_SALT',       '3i>NIPhK,fXbkB? TbC6=QfMB!{2,n>7spV^=bSnv.}QB@!{`5AZ~l+Hj[Gh>AZ[');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
