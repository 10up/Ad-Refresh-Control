/**
 * WordPress dependencies
 */
import { test, expect } from '@wordpress/e2e-test-utils-playwright';

/**
 * Internal dependencies
 */
import {
	DEFAULT_SETTINGS,
	getRefreshes,
	saveSettings,
	useGptStub,
} from '../../utils/helpers';

/*
 * The helper plugin (tests/e2e-plugins) puts two ad slots on every page and
 * lowers the refresh interval to 10 seconds. useGptStub() swaps Google's gpt.js
 * for a stub that records refreshes and fakes the page clock, so these specs
 * fast-forward instead of waiting and don't need network access.
 */
test.describe( 'Ad refresh', () => {
	test.afterEach( async ( { admin, page } ) => {
		await saveSettings( admin, page, DEFAULT_SETTINGS );
	} );

	test( 'refreshes viewable slots once the refresh interval has passed', async ( {
		page,
	} ) => {
		await useGptStub( page );
		await page.goto( '/' );

		await page.clock.runFor( 9_000 );
		expect( await getRefreshes( page ) ).toEqual( [] );

		await page.clock.runFor( 3_000 );
		expect( ( await getRefreshes( page ) ).sort() ).toEqual( [
			'ad-learning-1',
			'ad-learning-2',
		] );
	} );

	const exclusions = [
		{
			name: 'slot ID',
			settings: { slot_ids_to_exclude: 'ad-learning-2' },
			response: {},
		},
		{
			name: 'advertiser ID',
			settings: { advertiser_ids: '555' },
			response: { advertiserId: 555 },
		},
		{
			name: 'line item ID',
			settings: { line_item_ids: '777' },
			response: { lineItemId: 777 },
		},
		{
			name: 'size',
			settings: { sizes_to_exclude: '728x90' },
			response: { size: [ 728, 90 ] },
		},
	];

	for ( const { name, settings, response } of exclusions ) {
		test( `never refreshes a slot with an excluded ${ name }`, async ( {
			admin,
			page,
		} ) => {
			await saveSettings( admin, page, settings );
			await useGptStub( page, { 'ad-learning-2': response } );
			await page.goto( '/' );

			await page.clock.runFor( 12_000 );

			expect( await getRefreshes( page ) ).toEqual( [ 'ad-learning-1' ] );
		} );
	}

	test( 'stops refreshing a slot once it reaches the maximum refreshes', async ( {
		admin,
		page,
	} ) => {
		// The initial render counts, so 2 allows one refresh per slot.
		await saveSettings( admin, page, { maximum_refreshes: '2' } );
		await useGptStub( page );
		await page.goto( '/' );

		await page.clock.runFor( 45_000 );

		expect( ( await getRefreshes( page ) ).sort() ).toEqual( [
			'ad-learning-1',
			'ad-learning-2',
		] );
	} );

	test( 'hands refreshes to the avc_refresh_callback function instead of GPT', async ( {
		page,
	} ) => {
		await useGptStub( page );
		await page.addInitScript( () => {
			const calls: string[] = [];
			( window as any ).arcE2eCalls = calls;
			( window as any ).arcE2eRefresh = ( slots: any[] ) =>
				slots.forEach( ( slot ) =>
					calls.push( slot.getSlotElementId() )
				);
		} );
		await page.goto( '/?arc_e2e_refresh_callback=1' );

		await page.clock.runFor( 12_000 );

		expect(
			(
				await page.evaluate( () => ( window as any ).arcE2eCalls )
			).sort()
		).toEqual( [ 'ad-learning-1', 'ad-learning-2' ] );
		expect( await getRefreshes( page ) ).toEqual( [] );
	} );
} );
