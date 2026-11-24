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
class SettingsTest extends WP_UnitTestCase {

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

	/**
	 * Out-of-range numbers fall back to the default instead of being saved.
	 *
	 * @dataProvider data_out_of_range_values
	 *
	 * @param string $key      Setting key.
	 * @param string $input    Submitted value.
	 * @param int    $expected Value that must be saved.
	 */
	public function test_out_of_range_values_fall_back_to_defaults( string $key, string $input, int $expected ): void {
		update_option( 'avc_settings', array( $key => $input ) );

		$this->assertSame( $expected, get_option( 'avc_settings' )[ $key ] );
	}

	/**
	 * Out-of-range submissions and the defaults they fall back to.
	 *
	 * @return array[]
	 */
	public static function data_out_of_range_values(): array {
		return array(
			'viewability threshold above 100'    => array( 'viewability_threshold', '150', 70 ),
			'viewability threshold below 0'      => array( 'viewability_threshold', '-5', 70 ),
			'viewability threshold not a number' => array( 'viewability_threshold', 'all', 70 ),
			'maximum refreshes of 0'             => array( 'maximum_refreshes', '0', 10 ),
			'maximum refreshes not a number'     => array( 'maximum_refreshes', 'many', 10 ),
		);
	}

	/**
	 * Comma-separated ID fields are saved as lists of IDs, dropping anything that isn't one.
	 *
	 * @dataProvider data_exclusion_lists
	 *
	 * @param string $key      Setting key.
	 * @param string $input    Submitted comma-separated value.
	 * @param array  $expected IDs that must be saved, in order.
	 */
	public function test_exclusion_lists_are_saved_as_lists_of_ids( string $key, string $input, array $expected ): void {
		update_option( 'avc_settings', array( $key => $input ) );

		$this->assertSame( $expected, array_values( get_option( 'avc_settings' )[ $key ] ) );
	}

	/**
	 * Submitted exclusion lists and the IDs they must save as.
	 *
	 * @return array[]
	 */
	public static function data_exclusion_lists(): array {
		return array(
			'advertiser IDs, non-numeric dropped' => array( 'advertiser_ids', '125, abc, 594', array( 125, 594 ) ),
			'line item IDs, non-numeric dropped'  => array( 'line_item_ids', '42, x7, 99', array( 42, 99 ) ),
			'slot IDs, whitespace trimmed'        => array( 'slot_ids_to_exclude', 'div-gpt-ad-1 , div-gpt-ad-2', array( 'div-gpt-ad-1', 'div-gpt-ad-2' ) ),
		);
	}

	/**
	 * The disable checkbox is saved as a real boolean, so the front end can trust it.
	 */
	public function test_disable_refresh_is_saved_as_a_boolean(): void {
		update_option( 'avc_settings', array( 'disable_refresh' => '1' ) );
		$this->assertTrue( get_option( 'avc_settings' )['disable_refresh'], 'A ticked checkbox must save true.' );

		update_option( 'avc_settings', array( 'viewability_threshold' => '70' ) );
		$this->assertFalse( get_option( 'avc_settings' )['disable_refresh'], 'An unticked checkbox must save false.' );
	}
}
