<?php
/**
 * Plugin Name: Ad Viewability Control
 * Plugin URI:
 * Description: Enable Active View refresh for your ads.
 * Version:     0.2.0
 * Author:      10up
 * Author URI:  https://10up.com
 * Text Domain: ad-viewability-control
 * Domain Path: /languages
 *
 * @package AdViewabilityControl
 */

// Useful global constants.
define( 'AD_VIEWABILITY_CONTROL_VERSION', '0.2.0' );
define( 'AD_VIEWABILITY_CONTROL_URL', plugin_dir_url( __FILE__ ) );
define( 'AD_VIEWABILITY_CONTROL_PATH', plugin_dir_path( __FILE__ ) );
define( 'AD_VIEWABILITY_CONTROL_INC', AD_VIEWABILITY_CONTROL_PATH . 'includes/' );

// Include files.
require_once AD_VIEWABILITY_CONTROL_INC . 'functions/core.php';
require_once AD_VIEWABILITY_CONTROL_INC . 'settings.php';

// Activation/Deactivation.
register_activation_hook( __FILE__, '\AdViewabilityControl\Core\activate' );
register_deactivation_hook( __FILE__, '\AdViewabilityControl\Core\deactivate' );

// Bootstrap.
AdViewabilityControl\Core\setup();
AdViewabilityControl\Settings\setup();

// Require Composer autoloader if it exists.
if ( file_exists( AD_VIEWABILITY_CONTROL_PATH . '/vendor/autoload.php' ) ) {
	require_once AD_VIEWABILITY_CONTROL_PATH . 'vendor/autoload.php';
}
