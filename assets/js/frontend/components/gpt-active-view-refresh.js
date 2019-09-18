const {googletag} = window;
const advertiserId = 4788048711; // Only trigger active view refresh for the given advertiserId.
const viewabilityThreshold = 70; // Percentage of visibility above which to trigger active view refresh.
const refreshInterval = 3; // Time interval, in seconds, to refresh slots.
const viewedAds = {}; // Object to cache ad slot info.
const debug = true; // Set to true to force refresh timer behavior regardless of advertiserId, and to enable console logging.

/**
 * Start countdown timer to refreshing the given slot.
 * @param {number} slotId Slot ID string of the slot to refresh.
 * @param {object} slot   GPT Slot object to refresh.
 */
const startRefreshCountdown = ( slotId, slot ) => {
	if ( ! viewedAds[slotId].refreshing ) {
		if ( debug ) {
			console.log( `starting refresh countdown for ${  slotId}` );
		}

		viewedAds[slotId].startTime = new Date().valueOf();
		viewedAds[slotId].refreshing = window.setInterval( () => {
			const now = new Date().valueOf();
			const diff = Math.round( ( now - viewedAds[slotId].startTime ) / 1000 ); // Number of seconds elapsed since this slot last rendered/refreshed.

			if ( debug ) {
				console.log( `${diff  } seconds since last ${  slotId  } refresh` );
			}

			if ( diff >= refreshInterval ) {
				// Refresh ad slot.
				googletag.cmd.push( () => {
					if ( debug ) {
						console.log( `refreshing ${  slotId}` );
					}

					googletag.pubads().refresh( [ slot ] );
				} );

				// Reset timestamp of slot render.
				viewedAds[slotId].startTime = new Date().valueOf();
			}
		}, 1000 );
	}
};

/**
 * Kill the refresh countdown for the given slot.
 * @param {number} slotId slotId of slot to kill refresh counter.
 */
const killRefreshCountdown = ( slotId ) => {
	if ( viewedAds[slotId].refreshing ) {
		if ( debug ) {
			console.log( `killing refresh countdown for ${  slotId}` );
		}

		window.clearInterval( viewedAds[slotId].refreshing );
		viewedAds[slotId].refreshing = null;
	}
};

/**
 * Handle slotVisibilityChanged event.
 * @param {object} event googletag.events.SlotVisibilityChangedEvent
 * see: https://developers.google.com/doubleclick-gpt/reference#googletageventsslotvisibilitychangedevent
 */
const viewabilityHandler = ( event ) => {
	const {inViewPercentage} = event;
	const slotId = event.slot.getSlotElementId();
	const slotInfo = event.slot.getResponseInformation();

	if ( debug || slotInfo.advertiserId === advertiserId ) {
		if ( ! viewedAds[slotId] ) {
			viewedAds[slotId] = {};
		}

		if ( 'visible' === document.visibilityState && inViewPercentage >= viewabilityThreshold ) {
			startRefreshCountdown( slotId, event.slot );
		} else {
			killRefreshCountdown( slotId );
		}
	}
};

/**
 * Add event listeners for viewability.
 */
const viewabilityListener = () => {
	googletag.pubads().addEventListener( 'slotVisibilityChanged', viewabilityHandler );
};

/**
 * Init ads functionality.
 */
const init = () => {
	const timesToTry = 30; // number of times to try checking if googletag API is ready
	let tries = 0; // number of times we've tried initing googletag API

	// Check if GPT API is ready. If not, try again every 100ms up to 30x.
	if ( ! googletag || ! googletag.apiReady ) {
		const timeout = window.setTimeout( () => {
			if ( tries <= timesToTry ) {
				tries++;
				init();
			} else {
				console.error( 'Could not init GPT API.' );
			}

			window.clearTimeout( timeout );
		}, 100 );

		return;
	}

	viewabilityListener();
};

export default init;