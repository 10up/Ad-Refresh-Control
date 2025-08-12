/* eslint-disable no-mixed-spaces-and-tabs */
/* eslint-disable no-undef */
describe( 'Verify the Ad Refresh', () => {

	beforeEach( () => {
		cy.login();
	} );

	it( 'Verify ads exist and are refreshed', () => {

		let ad = '';
		let ad1 ='';
		cy.visit( '/' );
		cy.wait( 2000 );
		cy.get( '#ad-learning-1' )
			.invoke( 'attr', 'data-google-query-id' )
  			.then( ( dataId ) => {
				ad = dataId;
				return;
			} );
		cy.wait( 12000 );
		cy.get( '#ad-learning-1' )
			.invoke( 'attr', 'data-google-query-id' )
			.then( ( dataId1 ) => {
				ad1 = dataId1;
				cy.wrap( ad ).should( 'not.equal', ad1 );
				return;
			} );


	} );
} );
