<?php
/**
 * Tests for core plugin functionality.
 *
 * @package Ad-Refresh-Control
 */

namespace AdRefreshControl\Core;

use WP_UnitTestCase;

/**
 * Core functionality tests.
 */
class Core_Tests extends WP_UnitTestCase {

	/**
	 * Test that setup() registers the expected hooks.
	 */
	public function test_setup() {
		$this->assertNotFalse(
			has_action( 'init', __NAMESPACE__ . '\i18n' ),
			'init action should have i18n callback registered'
		);
		$this->assertNotFalse(
			has_action( 'init', __NAMESPACE__ . '\init' ),
			'init action should have init callback registered'
		);
		$this->assertNotFalse(
			has_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\scripts' ),
			'wp_enqueue_scripts action should have scripts callback registered'
		);
		$this->assertNotFalse(
			has_filter( 'script_loader_tag', __NAMESPACE__ . '\script_loader_tag' ),
			'script_loader_tag filter should have script_loader_tag callback registered'
		);
	}

	/**
	 * Test internationalization integration.
	 */
	public function test_i18n() {
		$plugin_locale_filter_called = false;
		$filter_callback              = function ( $locale, $domain ) use ( &$plugin_locale_filter_called ) {
			if ( 'ad-refresh-control' === $domain ) {
				$plugin_locale_filter_called = true;
			}
			return $locale;
		};
		add_filter( 'plugin_locale', $filter_callback, 10, 2 );

		i18n();

		$this->assertTrue(
			$plugin_locale_filter_called,
			'plugin_locale filter should be applied when i18n() runs'
		);

		remove_filter( 'plugin_locale', $filter_callback, 10 );
	}

	/**
	 * Test that init() fires the avc_init action.
	 */
	public function test_init() {
		$avc_init_fired = false;
		$callback       = function () use ( &$avc_init_fired ) {
			$avc_init_fired = true;
		};
		add_action( 'avc_init', $callback );

		init();

		$this->assertTrue( $avc_init_fired, 'avc_init action should fire when init() is called' );

		remove_action( 'avc_init', $callback );
	}

	/**
	 * Test activation routine fires avc_init.
	 */
	public function test_activate() {
		$avc_init_fired = false;
		$callback       = function () use ( &$avc_init_fired ) {
			$avc_init_fired = true;
		};
		add_action( 'avc_init', $callback );

		activate();

		$this->assertTrue( $avc_init_fired, 'avc_init action should fire when activate() is called' );

		remove_action( 'avc_init', $callback );
	}

	/**
	 * Test deactivation routine runs without error.
	 */
	public function test_deactivate() {
		deactivate();
		$this->assertTrue( true );
	}
}
