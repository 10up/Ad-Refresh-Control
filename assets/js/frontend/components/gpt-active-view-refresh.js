const {googletag} = window;
const advertiserIds = window.AdViewabilityControl.advertiserIds || []; // Do not trigger active view refresh for the given advertiserId.
const viewabilityThreshold = window.AdViewabilityControl.viewabilityThreshold || 70; // Percentage of visibility above which to trigger active view refresh.
const refreshInterval      = ( window.AdViewabilityControl.refreshInterval || 30 ) * 1000;
const maximumRefreshes = window.AdViewabilityControl.maximumRefreshes || 10;
let browserFocus = true;
const adsData = [];

/**
 * Check to see if any ads are ready to refresh.
 */
const checkForAdsReadyToRefresh = () => {
	const slotsToRefresh = [];

	if ( ! browserFocus ) {
		setTimeout( checkForAdsReadyToRefresh, 500 );
		return;
	}
	for ( const slot in adsData ) {
		if ( adsData.hasOwnProperty( slot ) ) {
			if ( ! adsData[ slot ].canRefresh || ! adsData[ slot ].viewable ||
					adsData[ slot ].viewability < viewabilityThreshold ) {
				continue;
			}
			adsData[ slot ].timeViewable += 500;
			if ( adsData[ slot ].timeViewable >= refreshInterval ) {
				slotsToRefresh.push( adsData[ slot ].slotObject );
				// Reset the time viewable to prevent a double refresh if the
				// rendering is slow.
				adsData[ slot ].timeViewable = 0;
			}
		}
	}

	if ( 0 < slotsToRefresh.length ) {
		googletag.pubads().refresh( slotsToRefresh );
	}

	setTimeout( checkForAdsReadyToRefresh, 500 );
};

/**
 * Handle impressionViewable event.
 * @param {object} event googletag.events.ImpressionViewableEvent
 * see: https://developers.google.com/doubleclick-gpt/reference#googletag.events.impressionviewableevent
 */
const impressionViewableHandler = ( event ) => {
	const slotID = event.slot.getSlotElementId();
	if ( ! slotID ) {
		return;
	}
	if ( 'undefined' === typeof adsData[ slotID ] ) {
		initializeSlotData( event.slot );
	}
	adsData[ slotID ].viewable = true;
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

	const slotID = event.slot.getSlotElementId();
	if ( 'undefined' === typeof adsData[ slotID ] ) {
		initializeSlotData( event.slot );
	}

	adsData[ slotID ].viewability = inViewPercentage;
};

/**
 * Handle slotRenderEnded event.
 * @param {object} event googletag.events.SlotRenderEndedEvent
 * see: https://developers.google.com/doubleclick-gpt/reference#googletag.events.slotrenderendedevent
 */
const slotRenderEndedHandler = ( event ) => {
	const slotID = event.slot.getSlotElementId();
	if ( ! slotID ) {
		return;
	}
	if ( 'undefined' === typeof adsData[ slotID ] ) {
		initializeSlotData( event.slot );
	} else {
		adsData[ slotID ].renderCount += 1;
		adsData[ slotID ].timeViewable = 0;
		adsData[ slotID ].viewable = false;
		adsData[ slotID ].canRefresh = isEligible( event.slot );
	}
};

/**
 * Initialize the data being recorded for the slot.
 * @param {object} slot A GPT slot object.
 */
const initializeSlotData = ( slot ) => {
	const slotID = slot.getSlotElementId();
	if ( ! slotID ) {
		return;
	}

	if ( 'undefined' !== typeof adsData[ slotID ] ) {
		return;
	}

	adsData[ slotID ] = {};
	adsData[ slotID ].viewable = true;
	// In the event the ad rendered before the plugin's event handlers were
	// added, we need to ensure the ad data is fully populated.
	adsData[ slotID ].renderCount = 1;
	adsData[ slotID ].timeViewable = 0;
	adsData[ slotID ].canRefresh = isEligible( slot );
	adsData[ slotID ].slotObject = slot;
	adsData[ slotID ].viewability = 0;
};

/**
 * Determine whether an ad slot should be eligible for active refresh.
 * @param {object} slot Slot object.
 * @returns bool
 */
const isEligible = ( slot ) => {
	const slotInfo = slot.getResponseInformation();
	if ( ! slotInfo ) {
		return false;
	}

	// Prevent a refresh if the ad has a blacklisted advertiser ID.
	if ( 'undefined' !== typeof advertiserIds[ slotInfo.advertiserId ] ) {
		return false;
	}

	// Enforce limit on maximum number of refreshes per slot.
	const slotID = slot.getSlotElementId();
	if ( 'undefined' !== typeof adsData[ slotID ] &&
			adsData[ slotID ].renderCount >= maximumRefreshes ) {
		return false;
	}

	return true;
};

/**
 * Add event listeners for viewability.
 */
const viewabilityListener = () => {
	googletag.pubads().addEventListener( 'impressionViewable', impressionViewableHandler );
	googletag.pubads().addEventListener( 'slotVisibilityChanged', viewabilityHandler );
	googletag.pubads().addEventListener( 'slotRenderEnded', slotRenderEndedHandler );
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
	const timesToTry = 30;
	let tries = 0;

	// Check if GPT API is ready. If not, try again.
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
	setTimeout( checkForAdsReadyToRefresh, 500 );
};

export default init;
