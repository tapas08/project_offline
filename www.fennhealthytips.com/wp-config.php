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
define('DB_NAME', 'hotel8cr_wp4');

/** MySQL database username */
define('DB_USER', 'hotel8cr_wp4');

/** MySQL database password */
define('DB_PASSWORD', 'S-W6p885j]');

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
define('AUTH_KEY',         '8rlbdmug3ftybiymvdfx995oyzah09zhhnox5bqtznuqzzg2kj6fwgujtljcrms6');
define('SECURE_AUTH_KEY',  'ppinvanl00ecdvrafasxiphjjrfiddnehbqbsskfannsyksmiwktqid0vuijbatd');
define('LOGGED_IN_KEY',    'tqju1eo1rc5u4jvl7qkm9xahca90qmwzfbuhlhyowcg1eiioud2s1akl5th7b1xj');
define('NONCE_KEY',        'nynfawaedj6q0vta9ghdgokukbpl65hji353kvcjnlldflb9kyanxtqwz5jp7l6l');
define('AUTH_SALT',        'fh0t8diyokr3bogr0lxrez9jorbdwauf4q3nf91autgmtlxj9etas5jfx2aahcsu');
define('SECURE_AUTH_SALT', '4d6jkny2jhwua0lignyh2gtbj4qpy0rboyqw2tibu7w38h59qrhkuvr6xdtrhgzo');
define('LOGGED_IN_SALT',   'gpjhyte1ruv4m6hpqihivlxbgftptvqmudhbyrcfh5fqycvyu8riupy3ofoo1cpl');
define('NONCE_SALT',       'prsz7t1npcun8ouzuilpxviytzz9f8y7s8cgeetr4uvq2oq2dqttv0j2eaiupmlj');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wplw_';

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
