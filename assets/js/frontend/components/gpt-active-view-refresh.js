const {googletag} = window;
let advertiserIds        = window.AdViewabilityControl.advertiserIds || []; // Do not trigger active view refresh for the given advertiserId.
if ( 0 < advertiserIds.length ) {
	const advertiserIdObject = {};
	for ( let i = 0, {length} = advertiserIds; i < length; i++ ) {
		advertiserIdObject[ advertiserIds[ i ] ] = 1;
	}
	advertiserIds = advertiserIdObject;
}
const viewabilityThreshold = window.AdViewabilityControl.viewabilityThreshold || 70; // Percentage of visibility above which to trigger active view refresh.
const refreshInterval      = window.AdViewabilityControl.refreshInterval || 30; // Time interval, in seconds, to refresh slots.
const viewedAds = {}; // Object to cache ad slot info.
let browserFocus = true;

/**
 * Start countdown timer to refreshing the given slot.
 * @param {number} slotId Slot ID string of the slot to refresh.
 * @param {object} slot   GPT Slot object to refresh.
 */
const startRefreshCountdown = ( slotId, slot ) => {

	if ( ! viewedAds[slotId].refreshing ) {
		viewedAds[slotId].startTime = new Date().valueOf();
		viewedAds[slotId].refreshing = window.setInterval( () => {
			const now = new Date().valueOf();
			const diff = Math.round( ( now - viewedAds[slotId].startTime ) / 1000 ); // Number of seconds elapsed since this slot last rendered/refreshed.

			if ( diff >= refreshInterval ) {
				if ( ! browserFocus ) {
					return;
				}
				// Refresh ad slot.
				googletag.cmd.push( () => {
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

	let {inViewPercentage} = event;

	if ( 'undefined' === typeof event.inViewPercentage ) {
		inViewPercentage = 100;
	}

	const slotId = event.slot.getSlotElementId();
	const slotInfo = event.slot.getResponseInformation();
	let refresh = true;

	// Prevent a refresh if the ad has the advertiser ID.
	if ( 0 < advertiserIds.length ) {
		if ( advertiserIds[ slotInfo.advertiserId ] ) {
			refresh = false;
		}
	}

	if ( refresh ) {
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
	googletag.pubads().addEventListener( 'impressionViewable', viewabilityHandler );
	googletag.pubads().addEventListener( 'slotVisibilityChanged', viewabilityHandler );
};

/**
 * Setup detection of whether the browser is focused.
 */
const setupBrowserFocusDetection = () => {
	if ( 'undefined' !== typeof document.hidden ) {
		browserFocus = ! document.hidden;
		document.addEventListener( 'visibilitychange', function() {
			browserFocus = ! document.hidden;
		} );
	} else if ( 'undefined' !== typeof document.onfocusin ) {
		document.onfocusin = indicatePageIsFocused;
		document.onfocusout = indicatePageIsNotFocused;
	} else {
		window.onfocus = indicatePageIsFocused;
		window.onblur = indicatePageIsNotFocused;
	}

	/**
	 * Set flag showing the page is in focus within the browser.
	 */
	function indicatePageIsFocused() {
		browserFocus = true;
	}

	/**
	 * Set flag showing the page has lost focus within the browser.
	 */
	function indicatePageIsNotFocused() {
		browserFocus = false;
	}
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
	setupBrowserFocusDetection();
};

export default init;
