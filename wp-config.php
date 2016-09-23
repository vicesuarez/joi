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
define('DB_NAME', 'joana_rodriguez');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'VszR}~dmgR`wSCOg~WYBFZ%d+Cj0Emu,>Eg4d#/R27!t0f%4KmLSlMya`S?uNqwJ');
define('SECURE_AUTH_KEY',  '~gQ_#L;&/ntXR0]I4t*.m$v0gp)w; q{%DZPr?`8QUg&UQBZN_R4}$%oHmh;f#C-');
define('LOGGED_IN_KEY',    '!p+SR50s,cN5t^YXep(0zo}~>u?pd{U0;th_zX`_0zJ:/_;-aU#$_pwO8fp4 QV@');
define('NONCE_KEY',        'R!6*X]P@Kz`C{4vN oa8jC{z?Z^J.jtk6w7ugyO5mom_.Z1sf?ql!3o,cK{^-kk/');
define('AUTH_SALT',        'HT1l$XNn!p8f`yPOb|Q{vlcDia*{1,u+-EePEa_U#_6Q]@5~s+q0/c4qs8gRI(M8');
define('SECURE_AUTH_SALT', '}!nx$iR:|`0E{7gxn2b/U}uYI%XQ0.uRW6#pUM`33Zdc47b~`{~Xt{Z5{3}O,f]b');
define('LOGGED_IN_SALT',   '3d`EV 3ZS %*(.{CXh~lGUE9Q O@)+.9Wi&`],lS^EO6}8]C#71B)H2mHNl]L|Zh');
define('NONCE_SALT',       '49Wv18PJ})oOq<.,9~9+6|C1DGw;kMOS/gE^~>~o.$kBxiRICf7voU[Nf?E#(y%$');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'joi_';

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
