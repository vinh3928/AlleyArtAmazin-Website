<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'h4alleyart2');

/** MySQL database username */
define('DB_USER', 'h4alleyart2');

/** MySQL database password */
define('DB_PASSWORD', 'AlleyQYGJR5!');

/** MySQL hostname */
define('DB_HOST', 'h4alleyart2.db.6372911.hostedresource.com');

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
define('AUTH_KEY',         'Nqt#1)/O-r(6WLroE&A@x7Gh;m~?hGY nrmQXU`m|G}t+rxLM+B0u]F;8]=R|u]e');
define('SECURE_AUTH_KEY',  '[U!M<c&~&6svF9V:Jn2&alx&K1<-wD>@ei+-YH)n-!4<|Vrl.x{(TM5I}+k#b7Tf');
define('LOGGED_IN_KEY',    '@|w-fR.+7-I;}JCUxszJSE)h1)2TkZn_QX 8{]e:258b2UBo,].H4Nq{suIyRd7_');
define('NONCE_KEY',        '~/i6z:Q.>Vdq~2-?-s<@XJk:jj,>_YI:h2VVP[Zj#|bi7uaYe .2%cyyipoRF~jl');
define('AUTH_SALT',        'PfSR(3v^WSlr.sErkZSiCcaVjtAj|+/CdVS?z;%{_&m3v-0jG!T/=%J^#L8o$:)a');
define('SECURE_AUTH_SALT', '~z;m)Ran+rH0nf%.q{yn!~[4!0f@?|ja-dP|]oj&[`B@M9EX(6uuJ]B9s=;:*d!X');
define('LOGGED_IN_SALT',   'fkf/KX{oE)Y(W9Y[,w3Hqs|%CM+>u143UR2LCB|mr,vKQnE^&Z%7,4[$OM N5|YC');
define('NONCE_SALT',       'M2N!aN`/#mC= >eBFvzhD[ZP,7Yo*+z/$n-q9=za2t#_|5qv*@.jbNRA?37b;C R');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'aa_';

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
