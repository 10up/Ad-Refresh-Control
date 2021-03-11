const {googletag} = window;
const advertiserIds = window.AdRefreshControl.advertiserIds || []; // Do not trigger active view refresh for the given advertiserId.
const viewabilityThreshold = window.AdRefreshControl.viewabilityThreshold || 70; // Percentage of visibility above which to trigger active view refresh.
const lineItemIds = window.AdRefreshControl.lineItemIds || []; // Do not trigger active view refresh for the given line item Ids.
const sizesToExclude = window.AdRefreshControl.sizesToExclude || []; // Do not trigger active view refresh for the given sizes.
const slotIdsToExclude = window.AdRefreshControl.slotIdsToExclude || []; // Do not trigger active view refresh for the given slot IDs.
const refreshInterval      = ( window.AdRefreshControl.refreshInterval || 30 ) * 1000;
const maximumRefreshes = window.AdRefreshControl.maximumRefreshes || 10;
const refreshCallback = window.AdRefreshControl.refreshCallback || false;
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
		if ( refreshCallback && 'function' === typeof window[refreshCallback] ) {
			window[refreshCallback]( slotsToRefresh );
		} else {
			googletag.pubads().refresh( slotsToRefresh );
		}
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
		initializeSlotData( event );
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
		initializeSlotData( event );
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
		initializeSlotData( event );
	} else {
		adsData[ slotID ].renderCount += 1;
		adsData[ slotID ].timeViewable = 0;
		adsData[ slotID ].viewable = false;
		adsData[ slotID ].canRefresh = isEligible( event );
	}
};

/**
 * Initialize the data being recorded for the slot.
 * @param {object} event googletag.events.SlotRenderEndedEvent
 * see: https://developers.google.com/doubleclick-gpt/reference#googletag.events.slotrenderendedevent
 */
const initializeSlotData = ( event ) => {
	const {slot} = event;
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
	adsData[ slotID ].canRefresh = isEligible( event );
	adsData[ slotID ].slotObject = slot;
	adsData[ slotID ].viewability = 0;
};

/**
 * Determine whether an ad slot should be eligible for active refresh.
 * @param {object} event googletag.events.SlotRenderEndedEvent
 * see: https://developers.google.com/doubleclick-gpt/reference#googletag.events.slotrenderendedevent
 * @returns bool
 */
const isEligible = ( event ) => {
	const {slot} = event;
	const slotInfo = slot.getResponseInformation();
	if ( ! slotInfo ) {
		return false;
	}

	let slotSize = event.size.toString();

	const slotSizes = slot.getSizes();
	const slotID = slot.getSlotElementId();

	// Prevent a refresh if the ad has a blacklisted advertiser ID.
	if ( 'undefined' !== typeof advertiserIds[ slotInfo.advertiserId ] ) {
		return false;
	}

	// Prevent a refresh if the line item ID is blacklisted.
	if ( 'undefined' !== typeof lineItemIds[slotInfo.lineItemId] ) {
		return false;
	}

	// Fluid returns 0x0 - ensure fluid is supported on the unit too.
	if ( '0,0' === slotSize && slotSizes.includes( 'fluid' ) ) {
		slotSize = 'fluid';
	}

	// Prevent a refresh if the slot size is blacklisted.
	if ( sizesToExclude.includes( slotSize ) ) {
		return false;
	}

	// Prevent a refresh if the slot ID is blacklisted.
	if ( 'undefined' !== typeof slotIdsToExclude[ slotID ] ) {
		return false;
	}

	// Enforce limit on maximum number of refreshes per slot.
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
