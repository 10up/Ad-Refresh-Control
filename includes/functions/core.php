<?php
/**
 * Core plugin functionality.
 *
 * @package AdViewabilityControl
 */

namespace AdViewabilityControl\Core;

use \WP_Error as WP_Error;

/**
 * Default setup routine
 *
 * @return void
 */
function setup() {
	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'init', $n( 'i18n' ) );
	add_action( 'init', $n( 'init' ) );
	add_action( 'wp_enqueue_scripts', $n( 'scripts' ) );

	// Hook to allow async or defer on asset loading.
	add_filter( 'script_loader_tag', $n( 'script_loader_tag' ), 10, 2 );

	do_action( 'avc_loaded' );
}

/**
 * Registers the default textdomain.
 *
 * @return void
 */
function i18n() {
	$locale = apply_filters( 'plugin_locale', get_locale(), 'ad-viewability-control' );
	load_textdomain( 'ad-viewability-control', WP_LANG_DIR . '/ad-viewability-control/ad-viewability-control-' . $locale . '.mo' );
	load_plugin_textdomain( 'ad-viewability-control', false, plugin_basename( AD_VIEWABILITY_CONTROL_PATH ) . '/languages/' );
}

/**
 * Initializes the plugin and fires an action other plugins can hook into.
 *
 * @return void
 */
function init() {
	do_action( 'avc_init' );
}

/**
 * Activate the plugin
 *
 * @return void
 */
function activate() {
	// First load the init scripts in case any rewrite functionality is being loaded
	init();
}

/**
 * Deactivate the plugin
 *
 * Uninstall routines should be in uninstall.php
 *
 * @return void
 */
function deactivate() {

}

/**
 * Generate an URL to a script, taking into account whether SCRIPT_DEBUG is enabled.
 *
 * @param string $script Script file name (no .js extension)
 *
 * @return string|WP_Error URL
 */
function script_url( $script ) {
	return AD_VIEWABILITY_CONTROL_URL . "dist/js/${script}.js";
}

/**
 * Enqueue scripts for front-end.
 *
 * @return void
 */
function scripts() {

	$avc_settings          = get_option( 'avc_settings' );
	$disable_refresh       = apply_filters(
		'avc_disable_refresh',
		$avc_settings['disable_refresh'] ?? false
	);
	$advertiser_ids        = $avc_settings['advertiser_ids'] ?? [];
	$viewability_threshold = $avc_settings['viewability_threshold'] ?? 70;
	$refresh_interval      = $avc_settings['refresh_interval'] ?? 30;
	$maximum_refreshes     = $avc_settings['maximum_refreshes'] ?? 10;

	if ( $disable_refresh ) {
		// No need to enqueue scripts if no refreshing will occur.
		return;
	}

	wp_enqueue_script(
		'avc_frontend',
		script_url( 'frontend', 'frontend' ),
		[],
		AD_VIEWABILITY_CONTROL_VERSION,
		true
	);


	wp_localize_script(
		'avc_frontend',
		'AdViewabilityControl',
		[
			'advertiserIds'        => apply_filters( 'avc_advertiser_ids', $advertiser_ids ),
			'viewabilityThreshold' => apply_filters( 'avc_viewability_threshold', $viewability_threshold ),
			'refreshInterval'      => apply_filters( 'avc_refresh_interval', $refresh_interval ),
			'maximumRefreshes'      => apply_filters( 'avc_maximum_refreshes', $maximum_refreshes ),
		]
	);
}

/**
 * Add async/defer attributes to enqueued scripts that have the specified script_execution flag.
 *
 * @link https://core.trac.wordpress.org/ticket/12009
 * @param string $tag    The script tag.
 * @param string $handle The script handle.
 * @return string
 */
function script_loader_tag( $tag, $handle ) {
	$script_execution = wp_scripts()->get_data( $handle, 'script_execution' );

	if ( ! $script_execution ) {
		return $tag;
	}

	if ( 'async' !== $script_execution && 'defer' !== $script_execution ) {
		return $tag; // _doing_it_wrong()?
	}

	// Abort adding async/defer for scripts that have this script as a dependency. _doing_it_wrong()?
	foreach ( wp_scripts()->registered as $script ) {
		if ( in_array( $handle, $script->deps, true ) ) {
			return $tag;
		}
	}

	// Add the attribute if it hasn't already been added.
	if ( ! preg_match( ":\s$script_execution(=|>|\s):", $tag ) ) {
		$tag = preg_replace( ':(?=></script>):', " $script_execution", $tag, 1 );
	}

	return $tag;
}
