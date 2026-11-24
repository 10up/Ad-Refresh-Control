<?php
/**
 * Tests for the front-end script and the data handed to it.
 *
 * @package AdRefreshControl
 */

namespace AdRefreshControl\Core;

use WP_Scripts;
use WP_UnitTestCase;

/**
 * The front-end script and its AdRefreshControl data.
 *
 * frontend.js checks exclusions by key presence (`'undefined' !== typeof ids[ id ]`)
 * and compares sizes against `event.size.toString()`, so the shape of this data
 * is a contract: a different shape silently disables every exclusion.
 */
class Scripts_Tests extends WP_UnitTestCase {

	/**
	 * The global script registry before the test.
	 *
	 * @var WP_Scripts|null
	 */
	private $old_wp_scripts;

	/**
	 * Gives each test an empty script registry.
	 */
	public function set_up(): void {
		parent::set_up();

		$this->old_wp_scripts  = $GLOBALS['wp_scripts'] ?? null;
		$GLOBALS['wp_scripts'] = new WP_Scripts();
	}

	/**
	 * Restores the global script registry.
	 */
	public function tear_down(): void {
		$GLOBALS['wp_scripts'] = $this->old_wp_scripts;
		parent::tear_down();
	}

	/**
	 * Advertiser and line item IDs go out as maps keyed by ID.
	 */
	public function test_advertiser_and_line_item_ids_are_keyed_by_id(): void {
		update_option(
			'avc_settings',
			array(
				'advertiser_ids' => array( 125, 594 ),
				'line_item_ids'  => array( 42 ),
			)
		);

		$data = $this->get_script_data();

		$this->assertSame(
			array(
				125 => 1,
				594 => 1,
			),
			$data['advertiserIds']
		);
		$this->assertSame( array( 42 => 1 ), $data['lineItemIds'] );
	}

	/**
	 * Slot IDs are trimmed before they become keys, so space-padded IDs still match (fixed in f73d5aa).
	 */
	public function test_slot_ids_are_trimmed_and_keyed_by_id(): void {
		update_option(
			'avc_settings',
			array( 'slot_ids_to_exclude' => array( ' div-gpt-ad-1', 'div-gpt-ad-2 ' ) )
		);

		$this->assertSame(
			array(
				'div-gpt-ad-1' => 1,
				'div-gpt-ad-2' => 1,
			),
			$this->get_script_data()['slotIdsToExclude']
		);
	}

	/**
	 * Sizes entered as "300x250" go out as "300,250", the format of GPT's size.toString().
	 */
	public function test_sizes_use_the_gpt_size_string_format(): void {
		update_option( 'avc_settings', array( 'sizes_to_exclude' => '300x250, fluid' ) );

		$this->assertSame( array( '300,250', 'fluid' ), $this->get_script_data()['sizesToExclude'] );
	}

	/**
	 * The script loads when refresh is enabled.
	 */
	public function test_script_is_enqueued_when_refresh_is_enabled(): void {
		update_option( 'avc_settings', array( 'disable_refresh' => false ) );

		scripts();

		$this->assertTrue( wp_script_is( 'avc_frontend', 'enqueued' ) );
	}

	/**
	 * The disable setting keeps the script off the page.
	 */
	public function test_disable_refresh_setting_keeps_the_script_off_the_page(): void {
		update_option( 'avc_settings', array( 'disable_refresh' => true ) );

		scripts();

		$this->assertFalse( wp_script_is( 'avc_frontend', 'enqueued' ) );
	}

	/**
	 * The avc_disable_refresh filter keeps the script off the page even when the setting is off.
	 */
	public function test_disable_refresh_filter_keeps_the_script_off_the_page(): void {
		update_option( 'avc_settings', array( 'disable_refresh' => false ) );
		add_filter( 'avc_disable_refresh', '__return_true' );

		scripts();

		$this->assertFalse( wp_script_is( 'avc_frontend', 'enqueued' ) );
	}

	/**
	 * Runs scripts() and returns the AdRefreshControl object it localizes.
	 *
	 * @return array
	 */
	private function get_script_data(): array {
		scripts();

		$inline = wp_scripts()->get_data( 'avc_frontend', 'data' );
		$this->assertIsString( $inline, 'scripts() must localize AdRefreshControl.' );
		$this->assertSame( 1, preg_match( '/var AdRefreshControl = (\{.*\});/s', $inline, $matches ) );

		return json_decode( $matches[1], true );
	}
}
