/* eslint-disable no-undef */
describe( 'Verify the Ad Refresh', () => {

	beforeEach( () => {
		cy.login();
	} );

	it( 'Open dashboard', () => {
		cy.visit( '/' );
		cy.get( '[aria-label="Advertisement"]' ).should( 'be.visible' );
	} );
} );
