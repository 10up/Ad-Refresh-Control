/* eslint-disable no-undef */
describe( 'Admin can login and open dashboard', () => {
	beforeEach( () => {
		cy.login();
	} );

	it( 'Open dashboard', () => {
		cy.visit( '/wp-admin/' );
		cy.get( 'h1' ).should( 'contain', 'Dashboard' );
	} );

	it( 'Set Ad Refresh Control Settings', () => {
		cy.visit( '/wp-admin/options-general.php?page=ad-refresh-control-settings' );
		cy.get( 'input[name="avc_settings[viewability_threshold]"]' ).clear();
		cy.get( 'input[name="avc_settings[viewability_threshold]"]' ).type( '10' );

		cy.get( 'input[name="avc_settings[refresh_interval]"]' ).clear();
		cy.get( 'input[name="avc_settings[refresh_interval]"]' ).type( '10' );

		cy.get( 'input[name="avc_settings[maximum_refreshes]"]' ).clear();
		cy.get( 'input[name="avc_settings[maximum_refreshes]"]' ).type( '10' );

		cy.get( '#submit' ).click();
		cy.get( '#setting-error-settings_updated' ).should( 'contain', 'Settings saved.' );
	} );
} );
