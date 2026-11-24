<?php
/**
 * Plugin Name: Ad Refresh Control E2E Helpers
 * Description: Test-only support plugin. Lowers the refresh interval to 10 seconds and injects a Google Ad Manager test slot so the E2E suite can watch it refresh. Loaded only by the wp-env configs.
 * Version: 0.1.0
 *
 * @package AdRefreshControl
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Refresh every 10 seconds instead of the 30-second minimum, so the refresh spec stays short.
add_filter(
	'avc_refresh_interval_value',
	static function () {
		return 10;
	}
);

add_action(
	'plugins_loaded',
	static function () {
		if ( ! function_exists( '\\AdRefreshControl\\Settings\\admin_menu' ) ) {
			// Ad Refresh Control isn't active, so there is nothing to test.
			return;
		}

		// Load GPT and define the public Google Ad Manager sample slot.
		add_action(
			'wp_head',
			static function () {
				?>
				<?php // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedScript -- Google's standard GPT snippet, test-only. ?>
				<script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
				<script>
				window.googletag = window.googletag || {cmd: []};
				googletag.cmd.push(function() {
					googletag.defineSlot('/50807014/learning', [[300, 250], [728, 90], [300, 600], [320, 50], [970, 90]], 'ad-learning-1').addService(googletag.pubads());
					googletag.pubads().enableSingleRequest();
					googletag.enableServices();
				});
				</script>
				<?php
			}
		);

		// Render the slot at the top of the page, inside the viewport.
		add_action(
			'wp_body_open',
			static function () {
				?>
				<div id='ad-learning-1' style='min-width: 300px; min-height: 50px;'>
				<script>
				googletag.cmd.push(function() { googletag.display('ad-learning-1'); });
				</script>
				</div>
				<?php
			}
		);
	}
);
