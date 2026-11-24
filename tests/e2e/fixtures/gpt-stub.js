/**
 * Stand-in for Google Publisher Tag (gpt.js), served by page.route() in the E2E specs.
 *
 * Implements only the parts of the googletag API that Ad Refresh Control and the
 * helper plugin's slot snippet use. Each displayed slot "renders" 100 ms later:
 * it fires slotRenderEnded, slotVisibilityChanged (100% in view) and
 * impressionViewable, the events frontend.js listens to. pubads().refresh()
 * records the slot IDs in window.gptStub.refreshes and renders those slots again.
 *
 * Specs can set window.gptStub.responses[ slotId ] = { advertiserId, lineItemId, size }
 * with page.addInitScript() before the page loads.
 */
( function () {
	const stub = ( window.gptStub = window.gptStub || {} );
	stub.responses = stub.responses || {};
	stub.refreshes = [];

	// Keep the page's googletag object: frontend.js may already hold a reference to it.
	const googletag = ( window.googletag = window.googletag || { cmd: [] } );
	const listeners = {};
	const slots = {};

	const fire = ( type, event ) =>
		( listeners[ type ] || [] ).forEach( ( listener ) =>
			listener( event )
		);

	const render = ( slot ) => {
		const response = stub.responses[ slot.getSlotElementId() ] || {};
		const size = response.size || [ 300, 250 ];
		fire( 'slotRenderEnded', { slot, size, isEmpty: false } );
		fire( 'slotVisibilityChanged', { slot, inViewPercentage: 100 } );
		fire( 'impressionViewable', { slot } );
	};

	const pubads = {
		addEventListener( type, listener ) {
			( listeners[ type ] = listeners[ type ] || [] ).push( listener );
			return pubads;
		},
		enableSingleRequest: () => true,
		refresh( refreshed ) {
			refreshed.forEach( ( slot ) => {
				stub.refreshes.push( slot.getSlotElementId() );
				setTimeout( () => render( slot ), 100 );
			} );
		},
	};

	googletag.apiReady = true;
	googletag.pubads = () => pubads;
	googletag.enableServices = () => {};
	googletag.defineSlot = ( adUnitPath, sizes, elementId ) => {
		const slot = {
			addService: () => slot,
			getSlotElementId: () => elementId,
			getSizes: () => sizes,
			getResponseInformation: () => {
				const response = stub.responses[ elementId ] || {};
				return {
					advertiserId: response.advertiserId ?? 1,
					lineItemId: response.lineItemId ?? 1,
				};
			},
		};
		slots[ elementId ] = slot;
		return slot;
	};
	googletag.display = ( elementId ) => {
		if ( slots[ elementId ] ) {
			setTimeout( () => render( slots[ elementId ] ), 100 );
		}
	};

	// Run commands queued before this script loaded, then run new ones at once.
	const queued = Array.isArray( googletag.cmd ) ? googletag.cmd : [];
	googletag.cmd = { push: ( fn ) => fn() };
	queued.forEach( ( fn ) => fn() );
} )();
