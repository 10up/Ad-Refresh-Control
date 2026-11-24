<?php
/**
 * Plugin Name: Ad Refresh Control E2E Helpers
 * Description: Test-only support plugin. Lowers the refresh interval to 10 seconds and adds two Google Ad Manager slots to every front-end page so the E2E suite can watch them refresh. Loaded only by the wp-env configs.
 * Version: 0.1.0
 *
 * @package AdRefreshControl
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Refresh every 10 seconds instead of the 30-second minimum, so the refresh specs stay short.
add_filter(
	'avc_refresh_interval_value',
	static function () {
		return 10;
	}
);

// ?arc_e2e_refresh_callback=1 hands refreshes to window.arcE2eRefresh through the avc_refresh_callback filter.
add_filter(
	'avc_refresh_callback',
	static function ( $callback ) {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Test-only switch, no state change.
		return isset( $_GET['arc_e2e_refresh_callback'] ) ? 'arcE2eRefresh' : $callback;
	}
);

add_action(
	'plugins_loaded',
	static function () {
		if ( ! function_exists( '\\AdRefreshControl\\Settings\\admin_menu' ) ) {
			// Ad Refresh Control isn't active, so there is nothing to test.
			return;
		}

		// Load GPT and define two slots on Google Ad Manager's public sample ad unit.
		// The specs replace gpt.js with tests/e2e/fixtures/gpt-stub.js.
		add_action(
			'wp_head',
			static function () {
				?>
				<?php // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedScript -- Google's standard GPT snippet, test-only. ?>
				<script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
				<script>
				window.googletag = window.googletag || {cmd: []};
				googletag.cmd.push(function() {
					googletag.defineSlot('/50807014/learning', [[300, 250], [728, 90]], 'ad-learning-1').addService(googletag.pubads());
					googletag.defineSlot('/50807014/learning', [[300, 250], [728, 90]], 'ad-learning-2').addService(googletag.pubads());
					googletag.pubads().enableSingleRequest();
					googletag.enableServices();
				});
				</script>
				<?php
			}
		);

		// Render both slots at the top of the page, inside the viewport.
		add_action(
			'wp_body_open',
			static function () {
				foreach ( array( 'ad-learning-1', 'ad-learning-2' ) as $slot_id ) {
					?>
					<div id="<?php echo esc_attr( $slot_id ); ?>" style="min-width: 300px; min-height: 50px;">
					<script>
					googletag.cmd.push(function() { googletag.display(<?php echo wp_json_encode( $slot_id ); ?>); });
					</script>
					</div>
					<?php
				}
			}
		);
	}
);
