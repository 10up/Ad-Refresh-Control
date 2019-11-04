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
	add_action( 'admin_init', __NAMESPACE__ . '\register_settings' );
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

		<form method="post" action="options.php">

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
	add_settings_field( 'disable_refresh', esc_html__( 'Disable Ad Refresh', 'ad-viewability-control' ), __NAMESPACE__ . '\disable_refresh_callback', 'ad-viewability-control', 'avc-section-1' );
	add_settings_field( 'viewability_threshold', esc_html__( 'Viewability Threshold', 'ad-viewability-control' ), __NAMESPACE__ . '\activate_viewability_threshold_callback', 'ad-viewability-control', 'avc-section-1' );
	add_settings_field( 'refresh_interval', esc_html__( 'Refresh Interval', 'ad-viewability-control' ), __NAMESPACE__ . '\refresh_interval_callback', 'ad-viewability-control', 'avc-section-1' );
	add_settings_field( 'advertiser_ids', esc_html__( 'Advertiser IDs', 'ad-viewability-control' ), __NAMESPACE__ . '\advertiser_ids_callback', 'ad-viewability-control', 'avc-section-1' );
	add_settings_field( 'debug', esc_html__( 'Activate Debug', 'ad-viewability-control' ), __NAMESPACE__ . '\debug_callback', 'ad-viewability-control', 'avc-section-1' );
}

/**
 * Output debug field.
 *
 * @since 1.0
 */
function disable_refresh_callback() {

	$avc_settings = get_option( 'avc_settings' );
	$value        = $avc_settings['disable_refresh'] ?? false;

	?>
		<label><input <?php checked( $value, true ); ?> type="checkbox" value="1" name="avc_settings[disable_refresh]">
			<?php esc_html_e( 'Disable ad refresh on all ads.', 'ad-viewability-control' ); ?>
		</label>
	<?php
}

/**
 * Output viewability threshold settings field
 *
 * @since 1.0
 */
function activate_viewability_threshold_callback() {

	$avc_settings = get_option( 'avc_settings' );
	$value        = $avc_settings['viewability_threshold'] ?? 70;

	?>
		<label><input type="text" value="<?php echo esc_attr( $value ); ?>" name="avc_settings[viewability_threshold]">
			<p><?php esc_html_e( 'Percentage of the ad which must be in the viewport.', 'ad-viewability-control' ); ?></p>
		</label>
	<?php
}

/**
 * Output refresh interval settings field
 *
 * @since 1.0
 */
function refresh_interval_callback() {

	$avc_settings = get_option( 'avc_settings' );
	$value        = $avc_settings['refresh_interval'] ?? 30;

	?>
		<label><input type="text" value="<?php echo esc_attr( $value ); ?>" name="avc_settings[refresh_interval]">
			<p><?php esc_html_e( 'How many seconds until the ads refresh?', 'ad-viewability-control' ); ?></p>
		</label>
	<?php
}

/**
 * Output the advertiser id settings field
 *
 * @since 1.0
 */
function advertiser_ids_callback() {

	$avc_settings = get_option( 'avc_settings' );
	$value        = $avc_settings['advertiser_ids'] ?? '';

	?>
		<label><input type="text" value="<?php echo esc_attr( $value ); ?>" name="avc_settings[advertiser_ids]">
			<p><?php esc_html_e( 'Prevent ad refresh\'s for specific Publisher IDs. (Comma Seperated Lists)', 'ad-viewability-control' ); ?></p>
		</label>
	<?php
}

/**
 * Output debug field.
 *
 * @since 1.0
 */
function debug_callback() {

	$avc_settings = get_option( 'avc_settings' );
	$value        = $avc_settings['debug'] ?? false;

	?>
		<label><input <?php checked( $value, true ); ?> type="checkbox" value="1" name="avc_settings[debug]">
			<?php esc_html_e( 'Display ad viewability data in the console.', 'ad-viewability-control' ); ?>
		</label>
	<?php
}

/**
 * Register settings for options table
 *
 * @since  1.0
 */
function register_settings() {
	register_setting( 'avc_settings', 'avc_settings', __NAMESPACE__ . '\sanitize_settings' );
}

/**
 * Sanitize settings for DB
 *
 * @param  array $settings Array of settings.
 * @since  1.0
 */
function sanitize_settings( $settings ) {
	return $settings;
}
