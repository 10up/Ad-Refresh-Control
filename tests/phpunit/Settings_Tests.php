<?php
/**
 * Tests for saving the plugin settings.
 *
 * @package AdRefreshControl
 */

namespace AdRefreshControl\Settings;

use WP_UnitTestCase;

/**
 * Saving avc_settings through the registered sanitize callback.
 */
class Settings_Tests extends WP_UnitTestCase {

	/**
	 * Registers the setting as an administrator, the way admin_init does on options.php.
	 */
	public function set_up(): void {
		parent::set_up();

		wp_set_current_user( self::factory()->user->create( array( 'role' => 'administrator' ) ) );
		register_settings();
	}

	/**
	 * Unregisters the setting so each test starts without its sanitize callback.
	 */
	public function tear_down(): void {
		unregister_setting( 'avc_settings', 'avc_settings' );
		parent::tear_down();
	}

	/**
	 * A refresh interval below 30 seconds is raised to the 30-second minimum on save.
	 */
	public function test_refresh_interval_below_minimum_is_raised_to_30_seconds(): void {
		update_option( 'avc_settings', array( 'refresh_interval' => '10' ) );

		$this->assertSame( 30, get_option( 'avc_settings' )['refresh_interval'] );
	}

	/**
	 * The avc_refresh_interval_value filter is the documented way to go below 30 seconds.
	 */
	public function test_refresh_interval_filter_allows_a_lower_interval(): void {
		add_filter(
			'avc_refresh_interval_value',
			static function () {
				return 10;
			}
		);

		update_option( 'avc_settings', array( 'refresh_interval' => '10' ) );

		$this->assertSame( 10, get_option( 'avc_settings' )['refresh_interval'] );
	}
}
