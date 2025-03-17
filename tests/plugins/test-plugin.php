<?php
/**
 * Plugin name: Testing 10up's Ad Refresh Control Plugin
 *
 * This is mini plugin can be used for testing the Ad Refresh Control plugin.
 *
 * It's best placed in your mu-plugins folder. There will be no effect if the
 * Ad Refresh Control plugin is disabled.
 */

add_filter( 'avc_refresh_interval_value', function() {
	return 10;
} );


add_action( 'plugins_loaded', function() {
	if ( ! function_exists( '\\AdRefreshControl\\Settings\\admin_menu' ) ) {
		// Not testing ads.
		return;
	}


	add_action( 'wp_head', function() {
		?>
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
	} );


	add_action( 'wp_body_open', function() {
		?>
		<div id='ad-learning-1' style='min-width: 300px; min-height: 50px;'>
		<script>
		googletag.cmd.push(function() { googletag.display('ad-learning-1'); });
		</script>
		</div>
		<?php
	} );
} );
