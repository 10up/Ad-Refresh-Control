# Ad Refresh Control

> Enable Active View refresh for Google Ad Manager ads without needing to modify any code.

[![Support Level](https://img.shields.io/badge/support-stable-blue.svg)](#support-level) [![Release Version](https://img.shields.io/github/release/10up/ad-refresh-control.svg)](https://github.com/10up/ad-refresh-control/releases/latest) ![WordPress tested up to version](https://img.shields.io/wordpress/plugin/tested/ad-refresh-control?label=WordPress) [![GPLv2 License](https://img.shields.io/github/license/10up/ad-refresh-control.svg)](https://github.com/10up/ad-refresh-control/blob/develop/LICENSE.md)

## Background & Purpose

There is always a drive for more page views to bring more ad impressions, but publishers can often leverage their current traffic and ad slots in order to further increase ad impressions by refreshing the ad slots after a given amount of time.

Previously this required a site's ad implementation code be modified, but not every publisher has the budget or engineers to enable this. Now with the 10up Ad Refresh Control Plugin publishers can enable the refreshing of their ads without needing to make any modifications to their existing ad implementation.

The increase in impressions will vary from site to site, depending largely on how quickly visitors scroll and how long they spend time on each page. Impressions can often be improved with the use of sticky ads, allowing ads to be sticky on the screen and have a better chance of being visible long enough to be refreshed, but enabling the 10up Ad Refresh Control Plugin will allow publishers to get started immediately.

A settings page will allow adjustments such as the time between refreshes, the maximum number of refreshes, and even list advertisers who would not be happy if their ads were refreshed, but smart defaults will be active for all settings out of the box so you can feel safe activating the plugin without consulting an ads expert first.

## Installation

1. [Download a zip file](http://github.com/10up/ad-refresh-control/archive/trunk.zip) and install via the WordPress plugin installer.

2. Go to the _WP-Admin > Settings > Ad Refresh Control_ settings page within the WordPress admin in order to adjust the settings to meet your specific needs. Settings that we've found useful for most sites will be used by default.

### Settings

![1. Ad Refresh Control plugin settings.](/.wordpress-org/screenshot-1.png)

- **Viewability Threshold:** The percentage of the ad slot which must be visible in the viewport in order to be considered eligible for being refreshed. It is recommended you do not lower this below 50 or you risk third-party viewability tracking platforms flagging your ad impressions as not having been viewed before refreshing.

- **Refresh Interval:** The number of seconds that must pass between an ad crossing the viewability threshold and the the ad refreshing. The plugin enforces a minimum of 30 in order to avoid your site being flagged for abusing ad refreshes by advertisers.

- **Maximum Refreshes:** The number of times each ad slot is allowed to be refreshed. If this is set to 4 then an ad slot could have a total of 5 impressions by combining the initial loading of the ad with the 4 times it can refresh.

- **Excluded Advertiser IDs:** Prevent ad refreshes for specific advertiser IDs in the format of a comma-separated list (e.g., 125,594,293). If an ad slot ever displays an ad creative from one of the listed advertiser IDs then that ad slot will stop refreshing for the remainder of the page view.

- **Line Items IDs to Exclude:** Prevent ad refreshes for specific line item IDs in the format of a comma-separated list (e.g., 125,594,293).

- **Sizes to Exclude:** Prevent ad refreshes for specific sizes in the format of a comma-separated list (e.g., 125,594,293). Sizes can be specified by name "fluid" or size 300x250, e.g. fluid,300x250.

- **Slot IDs to Exclude:** Prevent ad refreshes for specific slot IDs in the format of a comma-separated list based on the ID of the div, e.g. div-gpt-ad-grid-1.

### Hooks

#### `avc_refresh_interval_value` 
- Filters the default refresh interval value of 30 seconds. This filter is applied to the value at storage and retrieval phases.
- Since 1.0.5

**Usage:**

```
add_filter( 'avc_refresh_interval_value', 'my_filter_callback', 10, 1 );

/**
 * Filter refresh interval to 45 seconds.
 *
 * @param  int $interval The interval value to filter on.
 *
 * @return int The refresh interval, filtered or not.
 */
function my_filter_callback( $interval ) {
	$interval = 45;
	
	return $interval;
}
```

## Support Level

**Stable:** 10up is not planning to develop any new features for this, but will still respond to bug reports and security concerns. We welcome PRs, but any that include new features should be small and easy to integrate and should not include breaking changes. We otherwise intend to keep this tested up to the most recent version of WordPress.

## Changelog

A complete listing of all notable changes to Ad Refresh Control are documented in [CHANGELOG.md](/CHANGELOG.md).

## Contributing

Please read [CODE_OF_CONDUCT.md](/CODE_OF_CONDUCT.md) for details on our code of conduct, [CONTRIBUTING.md](/CONTRIBUTING.md) for details on the process for submitting pull requests to us, and [CREDITS.md](/CREDITS.md) for a listing of maintainers, contributors, and libraries for Ad Refresh Control.

## Like what you see?

<a href="http://10up.com/contact/"><img src="https://10up.com/uploads/2016/10/10up-Github-Banner.png" alt="Work with 10up, we create amazing websites and tools that make content management simple and fun using open source tools and platforms"></a>
