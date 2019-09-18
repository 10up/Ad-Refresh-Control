<?php
/**
 * Plugin Name: Active Ad Refresh
 * Plugin URI:
 * Description:
 * Version:     0.1.0
 * Author:      10up
 * Author URI:  https://10up.com
 * Text Domain: tenup-scaffold
 * Domain Path: /languages
 *
 * @package ActiveAdRefresh
 */

// Useful global constants.
define( 'ACTIVE_AD_REFRESH_VERSION', '0.1.0' );
define( 'ACTIVE_AD_REFRESH_URL', plugin_dir_url( __FILE__ ) );
define( 'ACTIVE_AD_REFRESH_PATH', plugin_dir_path( __FILE__ ) );
define( 'ACTIVE_AD_REFRESH_INC', ACTIVE_AD_REFRESH_PATH . 'includes/' );

// Include files.
require_once ACTIVE_AD_REFRESH_INC . 'functions/core.php';

// Activation/Deactivation.
register_activation_hook( __FILE__, '\ActiveAdRefresh\Core\activate' );
register_deactivation_hook( __FILE__, '\ActiveAdRefresh\Core\deactivate' );

// Bootstrap.
ActiveAdRefresh\Core\setup();

// Require Composer autoloader if it exists.
if ( file_exists( ACTIVE_AD_REFRESH_PATH . '/vendor/autoload.php' ) ) {
	require_once ACTIVE_AD_REFRESH_PATH . 'vendor/autoload.php';
}
