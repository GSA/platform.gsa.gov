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

//$link = mysql_connect( '10.0.2.2', 'root', '' );
//define('FORCE_SSL_LOGIN', true);
//define('FORCE_SSL_ADMIN', true);

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', getenv('RDS_DB_NAME'));

/** MySQL database username */
define('DB_USER', getenv('RDS_USERNAME'));

/** MySQL database password */
define('DB_PASSWORD', getenv('RDS_PASSWORD'));

/** MySQL hostname */
define('DB_HOST', getenv('RDS_HOSTNAME'));

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', getenv('RDS_CHARSET'));

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', getenv('RDS_COLLATE'));

/** CUSTOM SSL AWS RDS */
define('MYSQL_CLIENT_FLAGS', MYSQLI_CLIENT_SSL); //This activates SSL mode

define('MYSQL_SSL_CA', '/etc/ssl/certs/rds-combined-ca-bundle.pem');

/** Disable auto theme updater **/
define('CORE_UPGRADE_SKIP_NEW_BUNDLED', true);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         getenv('WP_HASH_AUTH_KEY'));
define('SECURE_AUTH_KEY',  getenv('WP_HASH_SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY',    getenv('WP_HASH_LOGGED_IN_KEY'));
define('NONCE_KEY',        getenv('WP_HASH_NONCE_KEY'));
define('AUTH_SALT',        getenv('WP_HASH_AUTH_SALT'));
define('SECURE_AUTH_SALT', getenv('WP_HASH_SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT',   getenv('WP_HASH_LOGGED_IN_SALT'));
define('NONCE_SALT',       getenv('WP_HASH_NONCE_SALT'));

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = getenv('WP_TABLE_PREFIX');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
//define('FORCE_SSL_ADMIN', true);
define('WP_DEBUG', getenv('WP_DEBUG_ENBALE'));
define('WP_ALLOW_MULTISITE', true);
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
$base = '/';
define('DOMAIN_CURRENT_SITE', getenv('SITE_HOSTNAME'));
define('PATH_CURRENT_SITE', getenv('WP_DEFAULT_PATH'));
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

//Fix Uploads
define('FS_METHOD',"direct");

//WP MAIL SMTP

define('WPMS_ON', true);
define('WPMS_MAIL_FROM', 'no-reply@platform.gsa.gov');
define('WPMS_MAIL_FROM_NAME', 'Platform.GSA.gov Admin');
define('WPMS_MAILER', 'smtp'); // Possible values 'smtp', 'mail', or 'sendmail'
define('WPMS_SET_RETURN_PATH', 'false'); // Sets $phpmailer->Sender if true
define('WPMS_SMTP_HOST', getenv('WP_SMTP_HOST')); // The SMTP mail host
define('WPMS_SMTP_PORT', getenv('WP_SMTP_PORT')); // The SMTP server port number
define('WPMS_SSL', getenv('WP_SMTP_SSL')); // Possible values '', 'ssl', 'tls' - note TLS is not STARTTLS
define('WPMS_SMTP_AUTH', true); // True turns on SMTP authentication, false turns it off
define('WPMS_SMTP_USER', getenv('WP_SMTP_USER')); // SMTP authentication username, only used if WPMS_SMTP_AUTH is true
define('WPMS_SMTP_PASS', getenv('WP_SMTP_PASS')); // SMTP authentication password, only used if WPMS_SMTP_AUTH is true

/** Amazon S3 Credentials for S3 Offload */

define( 'DBI_AWS_ACCESS_KEY_ID', getenv('WORDPRESS_AWSSDK2_ACCESS_KEY') );
define( 'DBI_AWS_SECRET_ACCESS_KEY', getenv('WORDPRESS_AWSSDK2_SECRET_KEY') );

//Increase Upload size
define('WP_MEMORY_LIMIT', '256M'); //env var
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

//Includes sunrise.php in the wp-contents directory
define( 'SUNRISE', 'on' );

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
