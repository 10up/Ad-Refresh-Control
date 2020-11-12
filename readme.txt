=== Ad Refresh Control ===
Contributors:      10up, doomwaxer, davidrgreen
Tags:              google, ad manager
Requires at least: 4.9
Tested up to:      5.5.1
Requires PHP:      7.0
Stable tag:        1.0.2
License:           GPLv2 or later
License URI:       http://www.gnu.org/licenses/gpl-2.0.html

Enable Active View refresh for Google Ad Manager ads without needing to modify any code.

== Description ==

There is always a drive for more page views to bring more ad impressions, but publishers can often leverage their current traffic and ad slots in order to further increase ad impressions by refreshing the ad slots after a given amount of time.

Previously this required a site's ad implementation code be modified, but not every publisher has the budget or engineers to enable this. Now with the 10up Ad Refresh Control Plugin publishers can enable the refreshing of their ads without needing to make any modifications to their existing ad implementation.

The increase in impressions will vary from site-to-site, depending largely on how quickly visitors scroll and how long they spend on each page. Impressions can often be improved with the use of sticky ads, allowing an ad(s) to be sticky on the screen and have a better chance of being visible long enough to be refreshed, but enabling the 10up Ad Refresh Control Plugin will allow publishers to get started immediately.

A settings page will allow adjustments such as the time between refreshes, the maximum number of refreshes, and even list advertisers who would not be happy if their ads were refreshed, but smart defaults will be active for all settings out of the box so you can feel safe activating the plugin without consulting an ads expert first.

== Installation ==

= Manual Installation =

1. [Download a zip file](http://github.com/10up/ad-refresh-control/archive/trunk.zip) and install via the WordPress plugin installer.
2. Go to the WP-Admin > Settings > Ad Refresh Control settings page within the WordPress admin in order to adjust the settings to meet your specific needs. Settings that we've found useful for most sites will be used by default.

= Settings =

__Viewability Threshold__: The percentage of the ad slot which must be visible in the viewport in order to be considered eligible for being refreshed. It's recommended you do not lower this below 50 or you risk third-party viewability tracking platforms flagging your ad impressions as not having been viewed before refreshing.

__Refresh Interval__: The number of seconds that must pass between an ad crossing the viewability threshold and the the ad refreshing. The plugin enforces a minimum of 30 in order to avoid your site being flagged for abusing ad refreshes by advertisers.

__Maximum Refreshes__: The number of times each ad slot is allowed to be refreshed. If this is set to 4 then an ad slot could have a total of 5 impressions by combining the initial loading of the ad with the 4 times it can refresh.

__Excluded Advertiser IDs__: Prevent ad refreshes for specific advertiser IDs in the format of a comma separated list (e.g., 125,594,293). If an ad slot ever displays an ad creative from one of the listed advertiser IDs then that ad slot will stop refreshing for the remainder of the page view.

== Screenshots ==

1. Ad Refresh Control plugin settings.

== Changelog ==

= 1.0.2 =
* **Added:** Support for additional exclusion rules - line item ID, ad unit size, and ad slot ID (props [@elliott-stocks](https://profiles.wordpress.org/elliott-stocks/), [@davidrgreen](https://profiles.wordpress.org/davidrgreen/)).
* **Added:** Linting GitHub Action (props [@jeffpaul](https://profiles.wordpress.org/jeffpaul/)).
* **Security:** Bump `dot-prop` from 4.2.0 to 4.2.1 (props [@dependabot](https://github.com/apps/dependabot)).

= 1.0.1 =
* **Added:** Plugin header and icon images (props [@jackiekjome](https://profiles.wordpress.org/jackiekjome/)).
* **Added:** GitHub Actions for deploys to WordPress.org (props [@jeffpaul](https://profiles.wordpress.org/jeffpaul/)).
* **Added:** Documentation updates (props [@jeffpaul](https://profiles.wordpress.org/jeffpaul/)).
* **Security:** Bump `lodash` from 4.17.15 to 4.17.19 (props [@dependabot](https://github.com/apps/dependabot)).
* **Security:** Bump `elliptic` from 6.4.1 to 6.5.3 (props [@dependabot](https://github.com/apps/dependabot)).

= 1.0.0 =
* **Added:** Initial public release! 🎉
