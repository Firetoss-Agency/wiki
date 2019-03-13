<?php

// If a local config file exists
if ( file_exists( dirname( __FILE__ ) . '/wp-config-local.php' ) ) {
	// Use these settings on the local server
 	include( dirname( __FILE__ ) . '/wp-config-local.php' );
} else {
	// Otherwise use the settings below on staging/production
	define('WP_HOME', 'http://wiki.ftscorch.com');
	define('WP_SITEURL', WP_HOME);

	// ** MySQL settings ** //
	/** The name of the database for WordPress */
	define('DB_NAME', 'db_wiki');

	/** MySQL database username */
	define('DB_USER', 'forge');

	/** MySQL database password */
	define('DB_PASSWORD', '4S0acP0xO3YZM8T1kGnP');

	/** MySQL hostname */
	define('DB_HOST', 'localhost');

	/** Define the environment, for Roots/Sage */
	define('WP_ENV', 'production');
}

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don\'t change this if in doubt. */
define('DB_COLLATE', '');

define('AUTH_KEY',         'gkqAeeHa+T7Fi8upwlbq0GjPLr4n7SgODzhx4M7TcOMnnbm6a/vwPshV64WKWCuwquL04ckSgmivrPkYXkCPaw==');
define('SECURE_AUTH_KEY',  'LJDOoaNEeV9xPZ3fqLXPIMLNWlXTbHpHSKbV+Hxrf+bRNNRJpH1mlDhw0XqzySHBQzEQkBoTC3jh5ANjOXp9sA==');
define('LOGGED_IN_KEY',    'twKoBlqfzDt4ozuQeQll1d4zJZuAj1CSIn81N0/oI2kdOTt+c/jx4ekoxfi7NJDKuBVX9x3rVDU129yCyijO1w==');
define('NONCE_KEY',        'OJOQ6AlORdDTyuvdpIluVrC8Sl34wt0U4yXRiuKVRnkivr8MsCC+Jx9cCguJ7vFOnT9rxbcVOt3fNSfm9eNa5g==');
define('AUTH_SALT',        'nHE7m6DSTAiGgOjwDsAdEFWTP7fS1NI1Voh39g42fgOj8H/FxRi8HapaerwSBrdhJkQdQrRKC3+9vmPwsSkYpQ==');
define('SECURE_AUTH_SALT', 'iCk5uFDC8iJbwEYAt3WkIYpCT4r+xLx6w8wLK9Wy+anm4yEDd+mW7b0SFhI6CyQyswvsa9JodoLXVwLzM18hRQ==');
define('LOGGED_IN_SALT',   '2EIqGRpQ4uHi6oNQ3tiAB0uZg/IVR+uwDOSUAkFPVVwWFp7RA59ed+Dc8SlXEA/9kD0vn3BZ6iH54CBoPIEZHw==');
define('NONCE_SALT',       'JxpTYmSEZZS1er+817MBJmuzd8bN8vCb9DkZLKsEmXzHFZu2VXpzQ/vujhMi4ngj3iJUaR7z9546i7E3M5tz5w==');

$table_prefix = 'ft_';

define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', false );
define( 'AUTOMATIC_UPDATER_DISABLED', false );
define( 'WP_AUTO_UPDATE_CORE', true );
// define( 'WPCF7_AUTOP', false );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
