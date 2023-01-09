=== Ad Refresh Control ===
Contributors:      10up, doomwaxer, davidrgreen, jeffpaul
Tags:              google, ad manager
Requires at least: 5.7
Tested up to:      6.1
Requires PHP:      7.4
Stable tag:        1.1.1
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

= 1.1.1 - 2023-01-05 =
* **Added:** Release build GitHub Action (props [@dkotter](https://github.com/dkotter) via [#99](https://github.com/10up/Ad-Refresh-Control/pull/99)).
* **Changed:** Bump WordPress minimum version from 4.9 to 5.7 and PHP minimum version from 7.0 to 7.4 (props [@jayedul](https://github.com/jayedul), [@dkotter](https://github.com/dkotter) via [#72](https://github.com/10up/Ad-Refresh-Control/pull/72)).
* **Changed:** Bump WordPress "tested up to" version to 6.1 (props [@jayedul](https://github.com/jayedul), [@dkotter](https://github.com/dkotter) via [#97](https://github.com/10up/Ad-Refresh-Control/pull/97)).
* **Changed:** [Support Level](https://github.com/10up/Ad-Refresh-Control#support-level) from `Active` to `Stable` (props [@jeffpaul](https://github.com/jeffpaul) via [#73](https://github.com/10up/Ad-Refresh-Control/pull/73)).
* **Removed:** `simple-git` as it is no longer used after updating ancestor dependency `lint-staged` (props [@dependabot](https://github.com/apps/dependabot) via [#82](https://github.com/10up/Ad-Refresh-Control/pull/82)).
* **Removed:** `is-svg` as it is no longer used after updating ancestor dependency `postcss-svgo` (props [@dependabot](https://github.com/apps/dependabot) via [#88](https://github.com/10up/Ad-Refresh-Control/pull/88)).
* **Fixed:** PHPCS workflow failures (props [@peterwilsoncc](https://github.com/peterwilsoncc), [@cadic](https://github.com/cadic) via [#84](https://github.com/10up/Ad-Refresh-Control/pull/84)).
* **Security:** Bump `terser` from 3.17.0 to 4.8.1 (props [@dependabot](https://github.com/apps/dependabot) via [#71](https://github.com/10up/Ad-Refresh-Control/pull/71)).
* **Security:** Bump `loader-utils` from 1.2.3 to 1.4.2 (props [@dependabot](https://github.com/apps/dependabot) via [#74](https://github.com/10up/Ad-Refresh-Control/pull/74)).
* **Security:** Bump `minimatch` from 3.0.4 to 3.1.2 (props [@dependabot](https://github.com/apps/dependabot) via [#76](https://github.com/10up/Ad-Refresh-Control/pull/76)).
* **Security:** Bump `engine.io` from 3.2.1 to 6.2.1 and `browser-sync` from 2.26.5 to 2.27.10 (props [@dependabot](https://github.com/apps/dependabot) via [#78](https://github.com/10up/Ad-Refresh-Control/pull/78), [#91](https://github.com/10up/Ad-Refresh-Control/pull/91)).
* **Security:** Bump `postcss` from 7.0.14 to 8.4.19 and `postcss-preset-env` from 5.3.0 to 7.8.3 (props [@dependabot](https://github.com/apps/dependabot) via [#81](https://github.com/10up/Ad-Refresh-Control/pull/81)).
* **Security:** Bump `lint-staged` from 8.1.5 to 13.0.3 (props [@dependabot](https://github.com/apps/dependabot) via [#82](https://github.com/10up/Ad-Refresh-Control/pull/82)).
* **Security:** Bump `set-value` from 2.0.0 to 2.0.1 and `union-value` from 1.0.0 to 1.0.1 (props [@dependabot](https://github.com/apps/dependabot) via [#86](https://github.com/10up/Ad-Refresh-Control/pull/86)).
* **Security:** Bump `yargs-parser` from 10.1.0 to 20.2.9, `stylelint` from 9.10.1 to 14.15.0, and `webpack-cli` from 3.3.1 to 3.3.12 (props [@dependabot](https://github.com/apps/dependabot) via [#87](https://github.com/10up/Ad-Refresh-Control/pull/87)).
* **Security:** Bump `postcss-svgo` from 4.0.2 to 4.0.3 (props [@dependabot](https://github.com/apps/dependabot) via [#88](https://github.com/10up/Ad-Refresh-Control/pull/88)).
* **Security:** Bump `nth-check` from 1.0.2 to 2.1.1 and `cssnano` from 4.1.10 to 5.1.14 (props [@dependabot](https://github.com/apps/dependabot) via [#89](https://github.com/10up/Ad-Refresh-Control/pull/89)).
* **Security:** Bump `trim-newlines` from 2.0.0 to 3.0.1 and `stylelint-declaration-use-variable` from 1.7.0 to 1.7.3 (props [@dependabot](https://github.com/apps/dependabot) via [#93](https://github.com/10up/Ad-Refresh-Control/pull/93)).
* **Security:** Bump `kind-of` from 6.0.2 to 6.0.3 (props [@dependabot](https://github.com/apps/dependabot) via [#94](https://github.com/10up/Ad-Refresh-Control/pull/94)).
* **Security:** Bump `serialize-javascript` from 1.7.0 to 4.0.0, `copy-webpack-plugin` from 5.0.3 to 5.1.2, and `terser-webpack-plugin` from 1.2.3 to 1.4.5 (props [@dependabot](https://github.com/apps/dependabot) via [#95](https://github.com/10up/Ad-Refresh-Control/pull/95)).
* **Security:** Bump `decode-uri-component` from 0.2.0 to 0.2.2 (props [@dependabot](https://github.com/apps/dependabot) via [#98](https://github.com/10up/Ad-Refresh-Control/pull/98)).

= 1.1.0 - 2022-06-27 =
* **Added:** Dependency security scanning (props [@jeffpaul](https://github.com/jeffpaul), [@Sidsector9](https://github.com/Sidsector9) via [#63](https://github.com/10up/Ad-Refresh-Control/pull/63)).
* **Changed:** Bump WordPress version "tested up to" 6.0 (props [@cadic](https://github.com/cadic) via [#66](https://github.com/10up/Ad-Refresh-Control/issues/66)).
* **Fixed:** PHP Warnings when pushing "Submit" on the settings page (props [@sksaju](https://github.com/sksaju), [@peterwilsoncc](https://github.com/peterwilsoncc) via [#60](https://github.com/10up/Ad-Refresh-Control/pull/60)).
* **Fixed:** Error when saving settings for the first time of using the plugin (props [@cadic](https://github.com/cadic), [@faisal-alvi](https://github.com/faisal-alvi) via [#67](https://github.com/10up/Ad-Refresh-Control/pull/67)).
* **Security:** Bump `color-string` from 1.5.3 to 1.5.5 (props [@dependabot](https://github.com/apps/dependabot) via [#51](https://github.com/10up/Ad-Refresh-Control/pull/51)).
* **Security:** Bump `path-parse` from 1.0.6 to 1.0.7 (props [@dependabot](https://github.com/apps/dependabot) via [#53](https://github.com/10up/Ad-Refresh-Control/pull/53)).
* **Security:** Bump `follow-redirects` from 1.7.0 to 1.14.8 (props [@dependabot](https://github.com/apps/dependabot) via [#55](https://github.com/10up/Ad-Refresh-Control/pull/55), [#57](https://github.com/10up/Ad-Refresh-Control/pull/57)).
* **Security:** Bump `ajv` from 6.10.0 to 6.12.6 (props [@dependabot](https://github.com/apps/dependabot) via [#56](https://github.com/10up/Ad-Refresh-Control/pull/56)).
* **Security:** Bump `tar` from 4.4.8 to 4.4.19 (props [@dependabot](https://github.com/apps/dependabot) via [#58](https://github.com/10up/Ad-Refresh-Control/pull/58)).

= 1.0.5 - 2021-06-23 =
* **Added:** `avc_refresh_interval_value` filter applied to default refresh interval value of 30 seconds (props [@simondowdles](https://profiles.wordpress.org/simondowdles/)).
* **Security:** Bump `y18n` from 3.2.1 to 3.2.2 (props [@dependabot](https://github.com/apps/dependabot)).
* **Security:** Bump `ssri` from 6.0.1 to 6.0.2 (props [@dependabot](https://github.com/apps/dependabot)).
* **Security:** Bump `lodash` from 4.17.19 to 4.17.21 (props [@dependabot](https://github.com/apps/dependabot)).
* **Security:** Bump `hosted-git-info` from 2.7.1 to 2.8.9 (props [@dependabot](https://github.com/apps/dependabot)).
* **Security:** Bump `browserslist` from 4.5.5 to 4.16.5 (props [@dependabot](https://github.com/apps/dependabot)).

= 1.0.4 - 2021-03-24 =
* **Fixed:** `initializeSlotData()` now correctly receives an event instead of a `Slot` (props [@enshrined](https://profiles.wordpress.org/enshrined/)).
* **Fixed:** `isEligible()` prevents Uncaught TypeError by checking if `event.size` exists before attempting to access it (props [@enshrined](https://profiles.wordpress.org/enshrined/)).
* **Security:** Bump `elliptic` from 6.5.3 to 6.5.4 (props [@enshrined](https://profiles.wordpress.org/enshrined/)).

= 1.0.3 - 2021-03-09 =
* **Added:** Custom callback and `avc_refresh_callback` filter to be used when an ad slot is ready for refresh (props [@enshrined](https://profiles.wordpress.org/enshrined/)).
* **Added:** Linting and testing GitHub Actions (props [@jeffpaul](https://profiles.wordpress.org/jeffpaul/), [@dinhtungdu](https://profiles.wordpress.org/dinhtungdu/)).
* **Changed:** Bump WordPress version "tested up to" 5.7 (props [@enshrined](https://profiles.wordpress.org/enshrined/))).
* **Fixed:** Issue within `viewabilityHandler()` where it was calling `initializeSlotData()` and passing the individual slot instead of the expected event (props [@enshrined](https://profiles.wordpress.org/enshrined/))).
* **Security:** Bump `ini` from 1.3.5 to 1.3.8 (props [@dependabot](https://github.com/apps/dependabot)).

= 1.0.2 - 2020-11-17 =
* **Added:** Support for additional exclusion rules - line item ID, ad unit size, and ad slot ID (props [@elliott-stocks](https://profiles.wordpress.org/elliott-stocks/), [@davidrgreen](https://profiles.wordpress.org/davidrgreen/)).
* **Added:** WordPress VIP support and exclusion for UsingCustomConstant PHPCS rule (props [@barryceelen](https://profiles.wordpress.org/barryceelen/)).
* **Changed:** Webpack config to use CoreJS 3 instead of 2 to handle ES7 polyfills (props [@davidrgreen](https://profiles.wordpress.org/davidrgreen/)).
* **Removed:** Unused namespace abstraction function (props [@barryceelen](https://profiles.wordpress.org/barryceelen/)).
* **Fixed:** Add check that explicitly verifies that `disable_refresh` is `true` before saving the setting (props [@barryceelen](https://github.com/barryceelen)).
* **Security:** Bump `dot-prop` from 4.2.0 to 4.2.1 (props [@dependabot](https://github.com/apps/dependabot)).

= 1.0.1 - 2020-09-30 =
* **Added:** Plugin header and icon images (props [@jackiekjome](https://profiles.wordpress.org/jackiekjome/)).
* **Added:** GitHub Actions for deploys to WordPress.org (props [@jeffpaul](https://profiles.wordpress.org/jeffpaul/)).
* **Added:** Documentation updates (props [@jeffpaul](https://profiles.wordpress.org/jeffpaul/)).
* **Security:** Bump `lodash` from 4.17.15 to 4.17.19 (props [@dependabot](https://github.com/apps/dependabot)).
* **Security:** Bump `elliptic` from 6.4.1 to 6.5.3 (props [@dependabot](https://github.com/apps/dependabot)).

= 1.0.0 - 2020-06-10 =
* **Added:** Initial public release! 🎉
