# 10up Ad Refresh Control Plugin

> Enable Active View refresh for Google Ad Manager ads without needing to modify any code.

[![Support Level](https://img.shields.io/badge/support-active-green.svg)](#support-level) [![Release Version](https://img.shields.io/github/release/10up/ad-refresh-control.svg)](https://github.com/10up/ad-refresh-control/releases/latest) ![WordPress tested up to version](https://img.shields.io/badge/WordPress-v5.4%20tested-success.svg) [![GPLv2 License](https://img.shields.io/github/license/10up/ad-refresh-control.svg)](https://github.com/10up/ad-refresh-control/blob/develop/LICENSE.md)

## Background & Purpose
There is always a drive for more page views to bring more ad impressions, but publishers can often leverage their current traffic and ad slots in order to further increase ad impressions by refreshing the ad slots after a given amount of time.

Previously this required a site's ad implementation code be modified, but not every publisher has the budget or engineers to enable this. Now with the 10up Ad Refresh Control Plugin publishers can enable the refreshing of their ads without needing to make any modifications to their existing ad implementation.

The increase in impressions will vary from site-to-site, depending largely on how quickly visitors scroll and how long they spend on each page. Impressions can often be improved with the use of sticky ads, allowing an ad(s) to be sticky on the screen and have a better chance of being visible long enough to be refreshed, but enabling the 10up Ad Refresh Control Plugin will allow publishers to get started immediately.

A settings page will allow adjustments such as the time between refreshes, the maximum number of refreshes, and even list advertisers who would not be happy if their ads were refreshed, but smart defaults will be active for all settings out of the box so you can feel safe activating the plugin without consulting an ads expert first.

## Installation
1. [Download a zip file](http://github.com/10up/ad-refresh-control/archive/master.zip) and install via the WordPress plugin installer.

2. Go to the _WP-Admin > Settings > Ad Refresh Control_ settings page within the WordPress admin in order to adjust the settings to meet your specific needs. Settings that we've found useful for most sites will be used by default.

### Settings

- **Viewability Threshold:** The percentage of the ad slot which must be visible in the viewport in order to be considered eligible for being refreshed. It's recommended you do not lower this below 50 or you risk third-party viewability tracking platforms flagging your ad impressions as not having been viewed before refreshing.

- **Refresh Interval:** The number of seconds that must pass between an ad crossing the viewability threshold and the the ad refreshing. The plugin enforces a minimum of 30 in order to avoid your site being flagged for abusing ad refreshes by advertisers.

- **Maximum Refreshes:** The number of times each ad slot is allowed to be refreshed. If this is set to 4 then an ad slot could have a total of 5 impressions by combining the initial loading of the ad with the 4 times it can refresh.

- **Excluded Advertiser IDs:** Prevent ad refreshes for specific advertiser IDs in the format of a comma separated list (e.g., 125,594,293). If an ad slot ever displays an ad creative from one of the listed advertiser IDs then that ad slot will stop refreshing for the remainder of the page view.

## Issues

If you identify any errors or have an idea for improving the plugin, please [open an issue](https://github.com/10up/ad-refresh-control/issues). We're excited to see what the community thinks of this project, and we would love your input!

## Support Level

**Active:** 10up is actively working on this, and we expect to continue work for the foreseeable future including keeping tested up to the most recent version of WordPress.  Bug reports, feature requests, questions, and pull requests are welcome.

## Changelog

A complete listing of all notable changes to Ad Refresh Control are documented in [CHANGELOG.md](/CHANGELOG.md).

## Contributing

Please read [CODE_OF_CONDUCT.md](/CODE_OF_CONDUCT.md) for details on our code of conduct, [CONTRIBUTING.md](/CONTRIBUTING.md) for details on the process for submitting pull requests to us, and [CREDITS.md](/CREDITS.md) for a listing of maintainers, contributors, and libraries for Ad Refresh Control.

## Like what you see?

<a href="http://10up.com/contact/"><img src="https://10updotcom-uploads.s3.amazonaws.com/uploads/2016/08/10up_github_banner-2.png" alt="Work with 10up, we create amazing websites and tools that make content management simple and fun using open source tools and platforms"></a>
