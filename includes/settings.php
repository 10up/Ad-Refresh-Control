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
	if ( apply_filters( 'avc_menu_access', current_user_can('administrator') ) ) {
		add_submenu_page(
			'options-general.php',
			esc_html__( 'Ad Viewability Control', 'ad-viewability-control' ),
			esc_html__( 'Ad Viewability Control', 'ad-viewability-control' ),
			'manage_options',
			'ad-viewability-control-settings',
			__NAMESPACE__ . '\settings_screen'
		);
	}
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
	add_settings_field( 'maximum_refreshes', esc_html__( 'Maximum Refreshes', 'ad-viewability-control' ), __NAMESPACE__ . '\maximum_refreshes_callback', 'ad-viewability-control', 'avc-section-1' );
	add_settings_field( 'advertiser_ids', esc_html__( 'Advertiser IDs', 'ad-viewability-control' ), __NAMESPACE__ . '\advertiser_ids_callback', 'ad-viewability-control', 'avc-section-1' );
}

/**
 * Output disable refresh field.
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
			<p><?php esc_html_e( 'How many seconds until the ads refresh? (minimum of 30)', 'ad-viewability-control' ); ?></p>
		</label>
	<?php
}

/**
 * Output maximum refreshes settings field
 *
 * @since 1.0
 */
function maximum_refreshes_callback() {

	$avc_settings = get_option( 'avc_settings' );
	$value        = $avc_settings['maximum_refreshes'] ?? 10;

	?>
		<label><input type="text" value="<?php echo esc_attr( $value ); ?>" name="avc_settings[maximum_refreshes]">
			<p><?php esc_html_e( 'What is the maximum number of times each ad slot should be allowed to refresh?', 'ad-viewability-control' ); ?></p>
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
	$value        = $avc_settings['advertiser_ids'] ?? [];

	?>
		<label><input type="text" value="<?php echo esc_attr( implode( ',', $value ) ); ?>" name="avc_settings[advertiser_ids]">
			<p><?php esc_html_e( 'Prevent ad refreshs for specific Publisher IDs. (Comma Seperated List)', 'ad-viewability-control' ); ?></p>
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

	// disable_refresh
	if ( isset( $settings['disable_refresh'] ) ) {
		$settings['disable_refresh'] = true;
	} else {
		$settings['disable_refresh'] = false;
	}

	// viewability_threshold
	$viewability_threshold_default = 70;
	if ( isset( $settings['viewability_threshold'] ) ) {
		if ( ! is_numeric( $settings['viewability_threshold'] ) || intval( $settings['viewability_threshold'] ) < 0 || intval( $settings['viewability_threshold'] ) > 100 ) {
			$settings['viewability_threshold'] = intval( $viewability_threshold_default );
		}
	} else {
		$settings['viewability_threshold'] = $viewability_threshold_default;
	}

	// refresh_interval
	$refresh_interval_default = 30;
	if ( isset( $settings['refresh_interval'] ) ) {
		if ( ! is_numeric( $settings['refresh_interval'] ) || intval( $settings['refresh_interval'] ) < 30 ) {
			$settings['refresh_interval'] = intval( $refresh_interval_default );
		}
	} else {
		$settings['refresh_interval'] = $refresh_interval_default;
	}

	// maximum_refreshes
	$maximum_refreshes_default = 10;

	if ( isset( $settings['maximum_refreshes'] ) ) {
		if ( ! is_numeric( $settings['maximum_refreshes'] ) || intval( $settings['maximum_refreshes'] ) < 1 ) {
			$settings['maximum_refreshes'] = $maximum_refreshes_default;
		}
	} else {
		$settings['maximum_refreshes'] = $maximum_refreshes_default;
	}

	// advertiser_ids
	$advertiser_ids_default = [];
	if ( isset( $settings['advertiser_ids'] ) ) {

		$advertiser_ids = explode( ',', $settings['advertiser_ids'] );

		$advertiser_ids = array_filter(
			$advertiser_ids,
			function( $advertiser_id ):int {
				return is_numeric( $advertiser_id );
			}
		);

		$settings['advertiser_ids'] = $advertiser_ids;
	} else {
		$settings['advertiser_ids'] = $advertiser_ids_default;
	}

	return $settings;
}
