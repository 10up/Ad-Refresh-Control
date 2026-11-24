/**
 * External dependencies
 */
import path from 'path';
import type { Page } from '@playwright/test';

/**
 * WordPress dependencies
 */
import type { Admin } from '@wordpress/e2e-test-utils-playwright';
import { expect } from '@wordpress/e2e-test-utils-playwright';

/**
 * Settings field values, keyed by the part inside avc_settings[…].
 */
export type Settings = Partial<
	Record<
		| 'viewability_threshold'
		| 'maximum_refreshes'
		| 'advertiser_ids'
		| 'line_item_ids'
		| 'sizes_to_exclude'
		| 'slot_ids_to_exclude',
		string
	>
>;

/**
 * The plugin defaults. Restoring them keeps specs independent.
 */
export const DEFAULT_SETTINGS: Settings = {
	viewability_threshold: '70',
	maximum_refreshes: '10',
	advertiser_ids: '',
	line_item_ids: '',
	sizes_to_exclude: '',
	slot_ids_to_exclude: '',
};

/**
 * Fills the given fields on the settings screen and saves.
 *
 * avc_settings isn't exposed over REST, so the settings form is the only way in.
 *
 * @param admin    Admin fixture.
 * @param page     Page fixture.
 * @param settings Field values to save.
 * @param disable  Whether to tick "Disable ad refresh".
 */
export async function saveSettings(
	admin: Admin,
	page: Page,
	settings: Settings,
	disable = false
) {
	await admin.visitAdminPage(
		'options-general.php',
		'page=ad-refresh-control-settings'
	);
	for ( const [ key, value ] of Object.entries( settings ) ) {
		await page
			.locator( `input[name="avc_settings[${ key }]"]` )
			.fill( value );
	}
	await page
		.locator( 'input[name="avc_settings[disable_refresh]"]' )
		.setChecked( disable );
	await page.getByRole( 'button', { name: 'Save Changes' } ).click();
	await expect( page.getByText( 'Settings saved.' ) ).toBeVisible();
}

/**
 * Serves the GPT stub (tests/e2e/fixtures/gpt-stub.js) instead of Google's gpt.js
 * and takes over the page clock, so specs fast-forward through refresh intervals.
 *
 * @param page      Page fixture.
 * @param responses Per-slot ad response, e.g. { 'ad-learning-2': { advertiserId: 555 } }.
 */
export async function useGptStub(
	page: Page,
	responses: Record<
		string,
		{ advertiserId?: number; lineItemId?: number; size?: number[] }
	> = {}
) {
	await page.route( '**/tag/js/gpt.js', ( route ) =>
		route.fulfill( {
			path: path.join( __dirname, '../fixtures/gpt-stub.js' ),
			contentType: 'application/javascript',
		} )
	);
	await page.addInitScript( ( stubResponses ) => {
		( window as any ).gptStub = { responses: stubResponses };
	}, responses );
	await page.clock.install();
}

/**
 * Slot IDs the page has refreshed so far, in order.
 *
 * @param page Page fixture.
 */
export function getRefreshes( page: Page ): Promise< string[] > {
	return page.evaluate( () => ( window as any ).gptStub.refreshes );
}
