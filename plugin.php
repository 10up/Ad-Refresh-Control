<?php
/**
 * Plugin Name: Ad Refresh Control
 * Plugin URI:
 * Description: Enable Active View refresh for Google Ad Manager ads without needing to modify any code.
 * Version:     1.0.0
 * Author:      10up
 * Author URI:  https://10up.com
 * Text Domain: ad-refresh-control
 * Domain Path: /languages
 *
 * @package AdRefreshControl
 */

// Useful global constants.
define( 'AD_REFRESH_CONTROL_VERSION', '1.0.0' );
define( 'AD_REFRESH_CONTROL_URL', plugin_dir_url( __FILE__ ) );
define( 'AD_REFRESH_CONTROL_PATH', plugin_dir_path( __FILE__ ) );
define( 'AD_REFRESH_CONTROL_INC', AD_REFRESH_CONTROL_PATH . 'includes/' );

// Include files.
require_once AD_REFRESH_CONTROL_INC . 'functions/core.php';
require_once AD_REFRESH_CONTROL_INC . 'settings.php';

// Activation/Deactivation.
register_activation_hook( __FILE__, '\AdRefreshControl\Core\activate' );
register_deactivation_hook( __FILE__, '\AdRefreshControl\Core\deactivate' );

// Bootstrap.
AdRefreshControl\Core\setup();
AdRefreshControl\Settings\setup();

// Require Composer autoloader if it exists.
if ( file_exists( AD_REFRESH_CONTROL_PATH . '/vendor/autoload.php' ) ) {
	require_once AD_REFRESH_CONTROL_PATH . 'vendor/autoload.php';
}
