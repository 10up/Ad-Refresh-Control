=== Ad Refresh Control ===
Contributors:      10up, doomwaxer, davidrgreen, jeffpaul
Tags:              google, ad manager
Tested up to:      7.1
Requires at least: 6.9
Stable tag:        1.2.0
License:           GPL-2.0-or-later
License URI:       https://spdx.org/licenses/GPL-2.0-or-later.html

Enable Active View refresh for Google Ad Manager ads without needing to modify any code.

== Description ==

There is always a drive for more page views to bring more ad impressions, but publishers can often leverage their current traffic and ad slots in order to further increase ad impressions by refreshing the ad slots after a given amount of time.

Previously this required a site's ad implementation code be modified, but not every publisher has the budget or engineers to enable this. Now with the 10up Ad Refresh Control Plugin publishers can enable the refreshing of their ads without needing to make any modifications to their existing ad implementation.

The increase in impressions will vary from site to site, depending largely on how quickly visitors scroll and how long they spend on each page. Impressions can often be improved with the use of sticky ads, allowing an ad(s) to be sticky on the screen and have a better chance of being visible long enough to be refreshed, but enabling the 10up Ad Refresh Control Plugin will allow publishers to get started immediately.

A settings page will allow adjustments such as the time between refreshes, the maximum number of refreshes, and even list advertisers who would not be happy if their ads were refreshed, but smart defaults will be active for all settings out of the box so you can feel safe activating the plugin without consulting an ads expert first.

== Installation ==

= Manual Installation =

1. [Download a zip file](http://github.com/10up/ad-refresh-control/archive/trunk.zip) and install via the WordPress plugin installer.
2. Go to the WP-Admin > Settings > Ad Refresh Control settings page within the WordPress admin in order to adjust the settings to meet your specific needs. Settings that we've found useful for most sites will be used by default.

= Settings =

__Viewability Threshold__: The percentage of the ad slot which must be visible in the viewport in order to be considered eligible for being refreshed. It is recommended you do not lower this below 50 or you risk third-party viewability tracking platforms flagging your ad impressions as not having been viewed before refreshing.

__Refresh Interval__: The number of seconds that must pass between an ad crossing the viewability threshold and the the ad refreshing. The plugin enforces a minimum of 30 in order to avoid your site being flagged for abusing ad refreshes by advertisers.

__Maximum Refreshes__: The number of times each ad slot is allowed to be refreshed. If this is set to 4 then an ad slot could have a total of 5 impressions by combining the initial loading of the ad with the 4 times it can refresh.

__Excluded Advertiser IDs__: Prevent ad refreshes for specific advertiser IDs in the format of a comma-separated list (e.g., 125,594,293). If an ad slot ever displays an ad creative from one of the listed advertiser IDs then that ad slot will stop refreshing for the remainder of the page view.

__Line Items IDs to Exclude__: Prevent ad refreshes for specific line item IDs in the format of a comma-separated list (e.g., 125,594,293).

__Sizes to Exclude__: Prevent ad refreshes for specific sizes in the format of a comma-separated list (e.g., 125,594,293). Sizes can be specified by name "fluid" or size 300x250, e.g. fluid,300x250.

__Slot IDs to Exclude__: Prevent ad refreshes for specific slot IDs in the format of a comma-separated list based on the ID of the div, e.g. div-gpt-ad-grid-1.

== Frequently Asked Questions ==

= Where do I report security bugs found in this plugin? =

Please report security bugs found in the source code of the Ad Refresh Control plugin through the [Patchstack Vulnerability Disclosure Program](https://patchstack.com/database/vdp/f87546b2-9abb-4cc0-96ed-38b6f8957286).  The Patchstack team will assist you with verification, CVE assignment, and notify the developers of this plugin.

== Screenshots ==

1. Ad Refresh Control plugin settings.

== Changelog ==

= 1.2.0 - 2026-09-01 =
* **Fixed:** PHP deprecation message: `Using ${var} in strings is deprecated...` (props [@peterwilsoncc](https://github.com/peterwilsoncc), [@blloyd78](https://github.com/blloyd78), [@dkotter](https://github.com/dkotter) via [#213](https://github.com/10up/Ad-Refresh-Control/pull/213)).
* **Fixed:** Trim whitespace from slot ID exclusion list entries to prevent space-padded keys from failing to match slot element IDs (props [@trrill](https://github.com/trrill), [@jeffpaul](https://github.com/jeffpaul), [@dkotter](https://github.com/dkotter), [@peterwilsoncc](https://github.com/peterwilsoncc) via [#205](https://github.com/10up/Ad-Refresh-Control/pull/205)).
* **Changed:** Bump WordPress minimum supported version to 6.9 (props [@mphillips](https://github.com/mphillips), [@peterwilsoncc](https://github.com/peterwilsoncc), [@dkotter](https://github.com/dkotter), [@jeffpaul](https://github.com/jeffpaul) via [#219](https://github.com/10up/Ad-Refresh-Control/pull/219)).
* **Changed:** Bump WordPress minimum supported version to 6.6 (props [@jeffpaul](https://github.com/jeffpaul), [@peterwilsoncc](https://github.com/peterwilsoncc) via [#175](https://github.com/10up/Ad-Refresh-Control/pull/175)).
* **Changed:** Bump "tested up to header" to indicate WordPress 7.1 support (props [@mphillips](https://github.com/mphillips), [@peterwilsoncc](https://github.com/peterwilsoncc), [@dkotter](https://github.com/dkotter), [@jeffpaul](https://github.com/jeffpaul) via [#219](https://github.com/10up/Ad-Refresh-Control/pull/219)).
* **Changed:** Bump "tested up to header" to indicate WordPress 6.9 support (props [@peterwilsoncc](https://github.com/peterwilsoncc), [@dkotter](https://github.com/dkotter), [@jeffpaul](https://github.com/jeffpaul) via [#184](https://github.com/10up/Ad-Refresh-Control/pull/184)).
* **Changed:** Bump "tested up to header" to indicate WordPress 6.8 support (props [@QAharshalkadu](https://github.com/QAharshalkadu), [@jeffpaul](https://github.com/jeffpaul), [@peterwilsoncc](https://github.com/peterwilsoncc) via [#176](https://github.com/10up/Ad-Refresh-Control/pull/176)).
* **Changed:** Bump "tested up to header" to indicate WordPress 6.8 support (props [@QAharshalkadu](https://github.com/QAharshalkadu), [@jeffpaul](https://github.com/jeffpaul), [@vikrampm1](https://github.com/vikrampm1), [@dkotter](https://github.com/dkotter), [@peterwilsoncc](https://github.com/peterwilsoncc) via [#174](https://github.com/10up/Ad-Refresh-Control/pull/174)).
* **Changed:** Bump "tested up to header" to indicate WordPress 6.7 support (props [@jjgrainger](https://github.com/jjgrainger), [@sudip-md](https://github.com/sudip-md), [@jeffpaul](https://github.com/jeffpaul), [@peterwilsoncc](https://github.com/peterwilsoncc) via [#166](https://github.com/10up/Ad-Refresh-Control/pull/166)).

= 1.1.5 - 2024-08-20 =
* **Added:** Better error handling for environments that don't match our minimum PHP version (props [@rahulsprajapati](https://github.com/rahulsprajapati), [@dkotter](https://github.com/dkotter), [@peterwilsoncc](https://github.com/peterwilsoncc) via [#123](https://github.com/10up/Ad-Refresh-Control/pull/123), [#157](https://github.com/10up/Ad-Refresh-Control/pull/157)).
* **Added:** Support for the WordPress.org plugin preview (props [@dkotter](https://github.com/dkotter), [@jeffpaul](https://github.com/jeffpaul) via [#138](https://github.com/10up/Ad-Refresh-Control/pull/138)).
* **Changed:** Bump WordPress "tested up to" version 6.6 (props [@sudip-md](https://github.com/sudip-md), [@ankitguptaindia](https://github.com/ankitguptaindia), [@jeffpaul](https://github.com/jeffpaul), [@dkotter](https://github.com/dkotter) via [#147](https://github.com/10up/Ad-Refresh-Control/pull/147), [#152](https://github.com/10up/Ad-Refresh-Control/pull/152)).
* **Changed:** Bump WordPress minimum supported version to 6.4 (props [@sudip-md](https://github.com/sudip-md), [@ankitguptaindia](https://github.com/ankitguptaindia), [@jeffpaul](https://github.com/jeffpaul), [@dkotter](https://github.com/dkotter) via [#147](https://github.com/10up/Ad-Refresh-Control/pull/147), [#152](https://github.com/10up/Ad-Refresh-Control/pull/152)).
* **Security:** Bump `browser-sync` from 2.28.3 to 3.0.2 (props [@dependabot](https://github.com/apps/dependabot), [@Sidsector9](https://github.com/Sidsector9) via [#142](https://github.com/10up/Ad-Refresh-Control/pull/142)).
* **Developer:** Clean up NPM dependencies and update node to v20 (props [@Sidsector9](https://github.com/Sidsector9), [@dkotter](https://github.com/dkotter) via [#155](https://github.com/10up/Ad-Refresh-Control/pull/155)).
* **Developer:** Move from `actions/upload-release-asset` to `softprops/action-gh-release` GitHub action (props [@Sidsector9](https://github.com/Sidsector9), [@jeffpaul](https://github.com/jeffpaul) via [#156](https://github.com/10up/Ad-Refresh-Control/pull/156)).
* **Developer:** Replaced `lee-dohm/no-response` with `actions/stale` to help with closing no-response/stale issues (props [@jeffpaul](https://github.com/jeffpaul), [@dkotter](https://github.com/dkotter) via [#145](https://github.com/10up/Ad-Refresh-Control/pull/145)).
* **Developer:** "Testing" section in the `CONTRIBUTING.md` file (props [@kmgalanakis](https://github.com/kmgalanakis), [@jeffpaul](https://github.com/jeffpaul) via [#146](https://github.com/10up/Ad-Refresh-Control/pull/146)).

= 1.1.4 - 2023-11-16 =
* **Changed:** Bump WordPress "tested up to" version 6.4 (props [@QAharshalkadu](https://github.com/QAharshalkadu), [@jeffpaul](https://github.com/jeffpaul) via [#134](https://github.com/10up/Ad-Refresh-Control/pull/134), [#135](https://github.com/10up/Ad-Refresh-Control/pull/135)).
* **Security:** Bump `postcss` from 8.4.25 to 8.4.31, `css-loader` from 2.1.1 to 6.8.1, `postcss-import` from 12.0.1 to 15.1.0, `postcss-loader` from 3.0.0 to 7.3.3 and `stylelint-order` from 1.0.0 to 6.0.3 (props [@dependabot](https://github.com/apps/dependabot), [@Sidsector9](https://github.com/Sidsector9) via [#127](https://github.com/10up/Ad-Refresh-Control/pull/127)).
* **Security:** Bump `@babel/traverse` from 7.4.3 to 7.23.2 (props [@dependabot](https://github.com/apps/dependabot), [@dkotter](https://github.com/dkotter) via [#131](https://github.com/10up/Ad-Refresh-Control/pull/131)).
* **Security:** Bump `browserify-sign` from 4.0.4 to 4.2.2 (props [@dependabot](https://github.com/apps/dependabot), [@ravinderk](https://github.com/ravinderk) via [#133](https://github.com/10up/Ad-Refresh-Control/pull/133)).

= 1.1.3 - 2023-10-16 =
* **Changed:** Updated the `skaut/wordpress-version-checker` to check WordPress "tested up to" during the Release Candidate phase (props [@jeffpaul](https://github.com/jeffpaul), [@iamdharmesh](https://github.com/iamdharmesh) via [#118](https://github.com/10up/Ad-Refresh-Control/pull/118)).
* **Changed:** Bump WordPress "tested up to" version 6.3 (props [@QAharshalkadu](https://github.com/QAharshalkadu), [@jeffpaul](https://github.com/jeffpaul), [@peterwilsoncc](https://github.com/peterwilsoncc) via [#125](https://github.com/10up/Ad-Refresh-Control/pull/125), [#126](https://github.com/10up/Ad-Refresh-Control/pull/126)).
* **Security:** Bump `stylelint` from 14.15.0 to 15.10.1 (props [@dependabot](https://github.com/apps/dependabot), [@ravinderk](https://github.com/ravinderk) via [#121](https://github.com/10up/Ad-Refresh-Control/pull/121)).
* **Security:** Bump `fsevents` from 1.2.8 to 1.2.13 (props [@dependabot](https://github.com/apps/dependabot), [@ravinderk](https://github.com/ravinderk) via [#128](https://github.com/10up/Ad-Refresh-Control/pull/128)).

[View historical changelog details here](https://github.com/10up/Ad-Refresh-Control/blob/develop/CHANGELOG.md).
