<?php
/**
 * Admin Settings.
 *
 * @package AdViewabilityControl
 */

namespace AdViewabilityControl\Settings;

/**
 * Default setup routine
 *
 * @return void
 */
function setup() {
	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'admin_menu', __NAMESPACE__ . '\admin_menu', 20 );
	add_action( 'admin_init', __NAMESPACE__ . '\setup_fields_sections' );
}

/**
 * Output setting menu option
 *
 * @since  1.0
 */
function admin_menu() {
	add_submenu_page(
		'options-general.php',
		esc_html__( 'Ad Viewability Control', 'ad-viewability-control' ),
		esc_html__( 'Ad Viewability Control', 'ad-viewability-control' ),
		'manage_options',
		'ad-viewability-control-settings',
		__NAMESPACE__ . '\settings_screen'
	);
}

/**
 * Output setting screen
 *
 * @since  1.0
 */
function settings_screen() {
	?>
	<div class="wrap">
		<h2><?php esc_html_e( 'Ad Viewability Control Settings', 'ad-viewability-control' ); ?></h2>

		<form action="options.php" method="post">

		<?php settings_fields( 'avc_settings' ); ?>
		<?php do_settings_sections( 'ad-viewability-control' ); ?>

		<?php submit_button(); ?>

		</form>
	</div>
	<?php
}

/**
 * Register setting fields and sections
 *
 * @since  1.0
 */
function setup_fields_sections() {
	add_settings_section( 'avc-section-1', '', '', 'ad-viewability-control' );
	add_settings_field( 'viewability_threshold', esc_html__( 'Viewability Threshold', 'ad-viewability-control' ), __NAMESPACE__ . '\activate_viewability_threshold_callback', 'ad-viewability-control', 'avc-section-1' );
	add_settings_field( 'activate_debug', esc_html__( 'Activate Debug', 'ad-viewability-control' ), __NAMESPACE__ . '\activate_debug_callback', 'ad-viewability-control', 'avc-section-1' );
}

/**
 * Output replace distributed author settings field
 *
 * @since 1.0
 */
function activate_viewability_threshold_callback() {
	$value = true;
	?>
	<label><input type="text" value="70" name="avc_settings[viewability_threshold]">
	<p><?php esc_html_e( 'Percentage of the ad which must be in the viewport.', 'ad-viewability-control' ); ?></p>
	</label>
	<?php
}

/**
 * Output debug field.
 *
 * @since 1.0
 */
function activate_debug_callback() {
	$value = true;
	?>
	<label><input <?php checked( $value, true ); ?> type="checkbox" value="1" name="avc_settings[activate_debug]">
	<?php esc_html_e( 'Display ad viewability data in the console.', 'ad-viewability-control' ); ?>
	</label>
	<?php
}
