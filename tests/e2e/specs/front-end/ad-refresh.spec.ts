/**
 * WordPress dependencies
 */
import { test, expect } from '@wordpress/e2e-test-utils-playwright';

/*
 * The helper plugin (tests/e2e-plugins) injects a Google Ad Manager sample
 * slot and lowers the refresh interval to 10 seconds. GPT never refreshes a
 * slot on its own, so a new query ID means Ad Refresh Control refreshed it.
 * Needs network access to securepubads.g.doubleclick.net.
 */
test.describe( 'Ad refresh', () => {
	test( 'refreshes a viewable ad slot after the refresh interval', async ( {
		page,
	} ) => {
		await page.goto( '/' );

		const slot = page.locator( '#ad-learning-1' );
		await expect( slot ).toHaveAttribute( 'data-google-query-id', /.+/, {
			timeout: 20_000,
		} );
		const firstQueryId = await slot.getAttribute( 'data-google-query-id' );

		await expect( slot ).not.toHaveAttribute(
			'data-google-query-id',
			firstQueryId as string,
			{ timeout: 30_000 }
		);
	} );
} );
