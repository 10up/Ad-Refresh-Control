/**
 * WordPress dependencies
 */
import { test, expect } from '@wordpress/e2e-test-utils-playwright';

/**
 * Internal dependencies
 */
import { DEFAULT_SETTINGS, saveSettings } from '../../utils/helpers';

test.describe( 'Settings screen', () => {
	// Put the settings back to their defaults so later specs see a refreshing site.
	test.afterEach( async ( { admin, page } ) => {
		await saveSettings( admin, page, DEFAULT_SETTINGS );
	} );

	test( 'saves the refresh settings', async ( { admin, page } ) => {
		await saveSettings( admin, page, {
			viewability_threshold: '80',
			maximum_refreshes: '5',
		} );

		await expect(
			page.locator( 'input[name="avc_settings[viewability_threshold]"]' )
		).toHaveValue( '80' );
		await expect(
			page.locator( 'input[name="avc_settings[maximum_refreshes]"]' )
		).toHaveValue( '5' );
	} );
} );
