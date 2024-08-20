<?php
/**
 * Plugin Name:       Ad Refresh Control
 * Plugin URI:        https://github.com/10up/Ad-Refresh-Control
 * Description:       Enable Active View refresh for Google Ad Manager ads without needing to modify any code.
 * Version:           1.1.5
 * Requires at least: 6.4
 * Requires PHP:      7.4
 * Author:            10up
 * Author URI:        https://10up.com
 * License:           GPL-2.0-or-later
 * License URI:       https://spdx.org/licenses/GPL-2.0-or-later.html
 * Text Domain:       ad-refresh-control
 * Domain Path:       /languages
 *
 * @package           AdRefreshControl
 */

namespace AdRefreshControl;

// Useful global constants.
define( 'AD_REFRESH_CONTROL_VERSION', '1.1.5' );
define( 'AD_REFRESH_CONTROL_URL', plugin_dir_url( __FILE__ ) );
define( 'AD_REFRESH_CONTROL_PATH', plugin_dir_path( __FILE__ ) );
define( 'AD_REFRESH_CONTROL_INC', AD_REFRESH_CONTROL_PATH . 'includes/' );

/**
 * Get the minimum version of PHP required by this plugin.
 *
 * @return string Minimum version required.
 */
function minimum_php_requirement() {
	return '7.4';
}

/**
 * Whether PHP installation meets the minimum requirements
 *
 * @return bool True if meets minimum requirements, false otherwise.
 */
function site_meets_php_requirements() {
	return version_compare( phpversion(), minimum_php_requirement(), '>=' );
}

// Ensuring our PHP version requirement is met first before loading plugin.
if ( ! site_meets_php_requirements() ) {
	add_action(
		'admin_notices',
		function() {
			?>
			<div class="notice notice-error">
				<p>
					<?php
					echo wp_kses_post(
						sprintf(
							/* translators: %s: Minimum required PHP version */
							__( 'Ad Refresh Control requires PHP version %s or later. Please upgrade PHP or disable the plugin.', 'ad-refresh-control' ),
							esc_html( minimum_php_requirement() )
						)
					);
					?>
				</p>
			</div>
			<?php
		}
	);
	return;
}

// phpcs:disable WordPressVIPMinimum.Files.IncludingFile.UsingCustomConstant
require_once AD_REFRESH_CONTROL_INC . 'functions/core.php';
require_once AD_REFRESH_CONTROL_INC . 'settings.php';

// Activation/Deactivation.
register_activation_hook( __FILE__, '\AdRefreshControl\Core\activate' );
register_deactivation_hook( __FILE__, '\AdRefreshControl\Core\deactivate' );

// Bootstrap.
Core\setup();
Settings\setup();

// Require Composer autoloader if it exists.
if ( file_exists( AD_REFRESH_CONTROL_PATH . '/vendor/autoload.php' ) ) {
	require_once AD_REFRESH_CONTROL_PATH . 'vendor/autoload.php';
}
