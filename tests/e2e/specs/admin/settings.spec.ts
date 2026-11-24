/**
 * WordPress dependencies
 */
import { test, expect } from '@wordpress/e2e-test-utils-playwright';

const SETTINGS_PAGE = 'options-general.php';
const SETTINGS_QUERY = 'page=ad-refresh-control-settings';

test.describe( 'Settings screen', () => {
	// Put the settings back to their defaults so later specs see a refreshing site.
	test.afterEach( async ( { admin, page } ) => {
		await admin.visitAdminPage( SETTINGS_PAGE, SETTINGS_QUERY );
		await page
			.locator( 'input[name="avc_settings[disable_refresh]"]' )
			.uncheck();
		await page
			.locator( 'input[name="avc_settings[viewability_threshold]"]' )
			.fill( '70' );
		await page
			.locator( 'input[name="avc_settings[maximum_refreshes]"]' )
			.fill( '10' );
		await page.getByRole( 'button', { name: 'Save Changes' } ).click();
		await expect( page.getByText( 'Settings saved.' ) ).toBeVisible();
	} );

	test( 'saves the refresh settings', async ( { admin, page } ) => {
		await admin.visitAdminPage( SETTINGS_PAGE, SETTINGS_QUERY );

		await page
			.locator( 'input[name="avc_settings[viewability_threshold]"]' )
			.fill( '80' );
		await page
			.locator( 'input[name="avc_settings[maximum_refreshes]"]' )
			.fill( '5' );
		await page.getByRole( 'button', { name: 'Save Changes' } ).click();

		await expect( page.getByText( 'Settings saved.' ) ).toBeVisible();
		await expect(
			page.locator( 'input[name="avc_settings[viewability_threshold]"]' )
		).toHaveValue( '80' );
		await expect(
			page.locator( 'input[name="avc_settings[maximum_refreshes]"]' )
		).toHaveValue( '5' );
	} );

	test( 'stops loading the refresh script when ad refresh is disabled', async ( {
		admin,
		page,
	} ) => {
		await page.goto( '/' );
		expect(
			await page.evaluate( () => 'AdRefreshControl' in window )
		).toBe( true );

		await admin.visitAdminPage( SETTINGS_PAGE, SETTINGS_QUERY );
		await page.getByLabel( 'Disable ad refresh on all ads.' ).check();
		await page.getByRole( 'button', { name: 'Save Changes' } ).click();
		await expect( page.getByText( 'Settings saved.' ) ).toBeVisible();

		await page.goto( '/' );
		expect(
			await page.evaluate( () => 'AdRefreshControl' in window )
		).toBe( false );
	} );
} );
