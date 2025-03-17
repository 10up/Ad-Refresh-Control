<?php
/**
 * Admin Settings.
 *
 * @package AdRefreshControl
 */

namespace AdRefreshControl\Settings;

/**
 * Default setup routine
 *
 * @return void
 */
function setup() {
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
		esc_html__( 'Ad Refresh Control', 'ad-refresh-control' ),
		esc_html__( 'Ad Refresh Control', 'ad-refresh-control' ),
		apply_filters( 'avc_menu_access', 'manage_options' ),
		'ad-refresh-control-settings',
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
		<h2><?php esc_html_e( 'Ad Refresh Control Settings', 'ad-refresh-control' ); ?></h2>

		<form method="post" action="options.php">

		<?php settings_fields( 'avc_settings' ); ?>
		<?php do_settings_sections( 'ad-refresh-control' ); ?>

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
	add_settings_section( 'arc-section-1', '', '', 'ad-refresh-control' );
	add_settings_field( 'disable_refresh', esc_html__( 'Disable Ad Refresh', 'ad-refresh-control' ), __NAMESPACE__ . '\disable_refresh_callback', 'ad-refresh-control', 'arc-section-1' );
	add_settings_field( 'viewability_threshold', esc_html__( 'Viewability Threshold', 'ad-refresh-control' ), __NAMESPACE__ . '\activate_viewability_threshold_callback', 'ad-refresh-control', 'arc-section-1' );
	add_settings_field( 'refresh_interval', esc_html__( 'Refresh Interval', 'ad-refresh-control' ), __NAMESPACE__ . '\refresh_interval_callback', 'ad-refresh-control', 'arc-section-1' );
	add_settings_field( 'maximum_refreshes', esc_html__( 'Maximum Refreshes', 'ad-refresh-control' ), __NAMESPACE__ . '\maximum_refreshes_callback', 'ad-refresh-control', 'arc-section-1' );
	add_settings_field( 'advertiser_ids', esc_html__( 'Excluded Advertiser IDs', 'ad-refresh-control' ), __NAMESPACE__ . '\advertiser_ids_callback', 'ad-refresh-control', 'arc-section-1' );
	add_settings_field( 'line_item_ids', esc_html__( 'Line Items IDs to Exclude', 'ad-refresh-control' ), __NAMESPACE__ . '\line_items_callback', 'ad-refresh-control', 'arc-section-1' );
	add_settings_field( 'sizes_to_exclude', esc_html__( 'Sizes to Exclude', 'ad-refresh-control' ), __NAMESPACE__ . '\sizes_to_exclude_callback', 'ad-refresh-control', 'arc-section-1' );
	add_settings_field( 'slot_ids_to_exclude', esc_html__( 'Slot IDs to Exclude', 'ad-refresh-control' ), __NAMESPACE__ . '\slot_ids_to_exclude_callback', 'ad-refresh-control', 'arc-section-1' );
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
			<?php esc_html_e( 'Disable ad refresh on all ads.', 'ad-refresh-control' ); ?>
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
			<p><?php esc_html_e( 'The percentage of the ad slot which must be visible in the viewport in order to be considered eligible for being refreshed. It\'s recommended you do not lower this below 50 or you risk third-party viewability tracking platforms flagging your ad impressions as not having been viewed before refreshing.', 'ad-refresh-control' ); ?></p>
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
	/**
	 * Refresh interval.
	 *
	 * Allows developers to filter the default refresh interval value of 30 seconds.
	 * We strongly advise developers to not filter this to a value less than 30 seconds.
	 * Filterable via the avc_refresh_interval_value filter hook.
	 *
	 * @since 1.0.5
	 * @link  https://github.com/10up/Ad-Refresh-Control/issues/46
	 *
	 * @param int $value The refresh interval in seconds. Defaults to 30.
	 */
	$value = absint( apply_filters( 'avc_refresh_interval_value', $value ) );

	?>
		<label><input type="text" value="<?php echo esc_attr( $value ); ?>" name="avc_settings[refresh_interval]">
			<p><?php esc_html_e( 'The number of seconds that must pass between an ad crossing the viewability threshold and the the ad refreshing. The plugin enforces a minimum of 30 in order to avoid your site being flagged for abusing ad refreshes by advertisers. This value may however be overridden via the avc_refresh_interval_value filter hook.', 'ad-refresh-control' ); ?></p>
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
			<p><?php esc_html_e( 'The number of times each ad slot is allowed to be refreshed. If this is set to 4 then an ad slot could have a total of 5 impressions by combining the initial loading of the ad with the 4 times it can refresh.', 'ad-refresh-control' ); ?></p>
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
			<p><?php esc_html_e( 'Prevent ad refreshes for specific advertiser IDs in the format of a comma-separated list (e.g., 125,594,293). If an ad slot ever displays an ad creative from one of the listed advertiser IDs then that ad slot will stop refreshing for the remainder of the page view.', 'ad-refresh-control' ); ?></p>
		</label>
	<?php
}

/**
 * Output the line items settings field.
 *
 * @since 1.0.2
 */
function line_items_callback() {
	$avc_settings = get_option( 'avc_settings' );
	$value        = $avc_settings['line_item_ids'] ?? [];

	?>
		<label><input type="text" value="<?php echo esc_attr( implode( ',', $value ) ); ?>" name="avc_settings[line_item_ids]">
			<p><?php esc_html_e( 'Prevent ad refreshes for specific line item IDs. (Comma-separated list)', 'ad-refresh-control' ); ?></p>
		</label>
	<?php
}

/**
 * Output the sizes to exclude field.
 *
 * @since 1.0.2
 */
function sizes_to_exclude_callback() {
	$avc_settings = get_option( 'avc_settings' );
	$value        = $avc_settings['sizes_to_exclude'] ?? '';

	?>
		<label><input type="text" value="<?php echo esc_attr( $value ); ?>" name="avc_settings[sizes_to_exclude]">
			<p><?php esc_html_e( 'Prevent ad refreshes for specific sizes. Accepts string (fluid) or array (300x250). Example: fluid, 300x250.', 'ad-refresh-control' ); ?></p>
		</label>
	<?php
}

/**
 * Output the slot IDs to exclude field.
 *
 * @since 1.0.2
 */
function slot_ids_to_exclude_callback() {
	$avc_settings = get_option( 'avc_settings' );
	$value        = $avc_settings['slot_ids_to_exclude'] ?? [];

	?>
		<label><input type="text" value="<?php echo esc_attr( implode( ',', $value ) ); ?>" name="avc_settings[slot_ids_to_exclude]">
			<p><?php esc_html_e( 'Prevent ad refreshes for specific slot IDs e.g. div-gpt-ad-grid-1. (Comma-separated list).', 'ad-refresh-control' ); ?></p>
		</label>
	<?php
}

/**
 * Register settings for options table
 *
 * @since  1.0
 */
function register_settings() {
	if ( apply_filters( 'avc_menu_access', current_user_can( 'manage_options' ) ) ) {
		register_setting( 'avc_settings', 'avc_settings', __NAMESPACE__ . '\sanitize_settings' );
	}
}

/**
 * Sanitize settings for DB
 *
 * @param  array $settings Array of settings.
 * @since  1.0
 */
function sanitize_settings( $settings ) {

	// disable_refresh
	if ( isset( $settings['disable_refresh'] ) && filter_var( $settings['disable_refresh'], FILTER_VALIDATE_BOOLEAN ) ) {
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

	/**
	 * Refresh interval.
	 *
	 * Allows developers to filter the default refresh interval value of 30 seconds.
	 * We strongly advise developers to not filter this to a value less than 30 seconds.
	 * Filterable via the avc_refresh_interval_value filter hook.
	 *
	 * @since 1.0.5
	 * @link  https://github.com/10up/Ad-Refresh-Control/issues/46
	 *
	 * @param int $refresh_interval_default The refresh interval in seconds. Defaults to 30.
	 */
	$refresh_interval_default = 30;
	$refresh_interval_default = absint( apply_filters( 'avc_refresh_interval_value', $refresh_interval_default ) );

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
	if ( ! empty( $settings['advertiser_ids'] ) ) {

		if ( is_array( $settings['advertiser_ids'] ) ) {
			$advertiser_ids = $settings['advertiser_ids'];
		} else {
			$advertiser_ids = explode( ',', $settings['advertiser_ids'] );
		}

		$advertiser_ids = array_filter(
			$advertiser_ids,
			function( $advertiser_id ):int {
				return is_numeric( $advertiser_id );
			}
		);
		$advertiser_ids = array_map(
			function( $advertiser_id ) {
				return (int) $advertiser_id;
			},
			$advertiser_ids
		);

		$settings['advertiser_ids'] = $advertiser_ids;
	} else {
		$settings['advertiser_ids'] = $advertiser_ids_default;
	}

	// Line item IDs.
	$line_item_ids_default = [];
	if ( ! empty( $settings['line_item_ids'] ) ) {

		if ( is_array( $settings['line_item_ids'] ) ) {
			$line_item_ids = $settings['line_item_ids'];
		} else {
			$line_item_ids = explode( ',', $settings['line_item_ids'] );
		}

		$line_item_ids = array_filter(
			$line_item_ids,
			function ( $line_item_id ):int {
				return is_numeric( $line_item_id );
			}
		);
		$line_item_ids = array_map(
			function ( $line_item_id ) {
				return (int) $line_item_id;
			},
			$line_item_ids
		);

		$settings['line_item_ids'] = $line_item_ids;
	} else {
		$settings['line_item_ids'] = $line_item_ids_default;
	}

	// Sizes.
	$sizes_to_exclude_default = '';
	if ( ! empty( $settings['sizes_to_exclude'] ) ) {
		$sizes                        = sanitize_text_field( $settings['sizes_to_exclude'] );
		$settings['sizes_to_exclude'] = $sizes;
	} else {
		$settings['sizes_to_exclude'] = $sizes_to_exclude_default;
	}

	// Slot IDs.
	$slot_ids_to_exclude_default = [];
	if ( ! empty( $settings['slot_ids_to_exclude'] ) ) {

		if ( is_array( $settings['slot_ids_to_exclude'] ) ) {
			$slot_ids_to_exclude = $settings['slot_ids_to_exclude'];
		} else {
			$slot_ids_to_exclude = explode( ',', $settings['slot_ids_to_exclude'] );
		}

		$slot_ids_to_exclude = array_filter(
			$slot_ids_to_exclude,
			function ( $slot_id ):int {
				return is_string( $slot_id );
			}
		);
		$slot_ids_to_exclude = array_map(
			function ( $slot_id ) {
				return (string) $slot_id;
			},
			$slot_ids_to_exclude
		);

		$settings['slot_ids_to_exclude'] = $slot_ids_to_exclude;
	} else {
		$settings['slot_ids_to_exclude'] = $slot_ids_to_exclude_default;
	}

	return $settings;
}
