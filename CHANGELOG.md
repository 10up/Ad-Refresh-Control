# Changelog

All notable changes to this project will be documented in this file, per [the Keep a Changelog standard](http://keepachangelog.com/), and will adhere to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased] - TBD

## [1.1.0] - 2022-06-27

### Added

- Dependency security scanning (props [@jeffpaul](https://github.com/jeffpaul), [@Sidsector9](https://github.com/Sidsector9) via [#63](https://github.com/10up/Ad-Refresh-Control/pull/63)).

### Changed

- Bump WordPress version "tested up to" 6.0 (props [@cadic](https://github.com/cadic) via [#66](https://github.com/10up/Ad-Refresh-Control/issues/66)).

### Fixed

- PHP Warnings when pushing "Submit" on the settings page (props [@sksaju](https://github.com/sksaju), [@peterwilsoncc](https://github.com/peterwilsoncc) via [#60](https://github.com/10up/Ad-Refresh-Control/pull/60)).
- Error when saving settings for the first time of using the plugin (props [@cadic](https://github.com/cadic), [@faisal-alvi](https://github.com/faisal-alvi) via [#67](https://github.com/10up/Ad-Refresh-Control/pull/67)).

### Security

- Bump `color-string` from 1.5.3 to 1.5.5 (props [@dependabot](https://github.com/apps/dependabot) via [#51](https://github.com/10up/Ad-Refresh-Control/pull/51)).
- Bump `path-parse` from 1.0.6 to 1.0.7 (props [@dependabot](https://github.com/apps/dependabot) via [#53](https://github.com/10up/Ad-Refresh-Control/pull/53)).
- Bump `follow-redirects` from 1.7.0 to 1.14.8 (props [@dependabot](https://github.com/apps/dependabot) via [#55](https://github.com/10up/Ad-Refresh-Control/pull/55), [#57](https://github.com/10up/Ad-Refresh-Control/pull/57)).
- Bump `ajv` from 6.10.0 to 6.12.6 (props [@dependabot](https://github.com/apps/dependabot) via [#56](https://github.com/10up/Ad-Refresh-Control/pull/56)).
- Bump `tar` from 4.4.8 to 4.4.19 (props [@dependabot](https://github.com/apps/dependabot) via [#58](https://github.com/10up/Ad-Refresh-Control/pull/58)).

## [1.0.5] - 2021-06-23
### Added
- `avc_refresh_interval_value` filter applied to default refresh interval value of 30 seconds (props [@10upsimon](https://github.com/10upsimon) via [#48](https://github.com/10up/Ad-Refresh-Control/pull/48)).

### Security
- Bump `y18n` from 3.2.1 to 3.2.2 (props [@dependabot](https://github.com/apps/dependabot) via [#42](https://github.com/10up/Ad-Refresh-Control/pull/42)).
- Bump `ssri` from 6.0.1 to 6.0.2 (props [@dependabot](https://github.com/apps/dependabot) via [#43](https://github.com/10up/Ad-Refresh-Control/pull/43)).
- Bump `lodash` from 4.17.19 to 4.17.21 (props [@dependabot](https://github.com/apps/dependabot) via [#44](https://github.com/10up/Ad-Refresh-Control/pull/44)).
- Bump `hosted-git-info` from 2.7.1 to 2.8.9 (props [@dependabot](https://github.com/apps/dependabot) via [#45](https://github.com/10up/Ad-Refresh-Control/pull/45)).
- Bump `browserslist` from 4.5.5 to 4.16.5 (props [@dependabot](https://github.com/apps/dependabot) via [#47](https://github.com/10up/Ad-Refresh-Control/pull/47)).

## [1.0.4] - 2021-03-24
### Fixed
- `initializeSlotData()` now correctly receives an event instead of a `Slot` (props [@darylldoyle](https://github.com/darylldoyle) via [#39](https://github.com/10up/Ad-Refresh-Control/pull/39)).
- `isEligible()` prevents Uncaught TypeError by checking if `event.size` exists before attempting to access it (props [@darylldoyle](https://github.com/darylldoyle) via [#39](https://github.com/10up/Ad-Refresh-Control/pull/39)).

### Security
- Bump `elliptic` from 6.5.3 to 6.5.4 (props [@dependabot](https://github.com/apps/dependabot) via [#37](https://github.com/10up/Ad-Refresh-Control/pull/37)).

## [1.0.3] - 2021-03-09
### Added
- Custom callback and `avc_refresh_callback` filter to be used when an ad slot is ready for refresh (props [@darylldoyle](https://github.com/darylldoyle) via [#34](https://github.com/10up/Ad-Refresh-Control/pull/34)).
- Linting and testing GitHub Actions (props [@jeffpaul](https://github.com/jeffpaul), [@dinhtungdu](https://github.com/dinhtungdu) via [#24](https://github.com/10up/Ad-Refresh-Control/pull/24)).

### Changed
- Bump WordPress version "tested up to" 5.7 (props [@darylldoyle](https://github.com/darylldoyle) via [#32](https://github.com/10up/Ad-Refresh-Control/issues/32)).

### Fixed
- Issue within `viewabilityHandler()` where it was calling `initializeSlotData()` and passing the individual slot instead of the expected event (props [@darylldoyle](https://github.com/darylldoyle) via [#34](https://github.com/10up/Ad-Refresh-Control/pull/34)).

### Security
- Bump `ini` from 1.3.5 to 1.3.8 (props [@dependabot](https://github.com/apps/dependabot) via [#33](https://github.com/10up/Ad-Refresh-Control/pull/33)).

## [1.0.2] - 2020-11-17
### Added
- Support for additional exclusion rules - line item ID, ad unit size, and ad slot ID (props [@elliott-stocks](https://github.com/elliott-stocks), [@davidrgreen](https://github.com/davidrgreen) via [#22](https://github.com/10up/Ad-Refresh-Control/pull/22)).
- WordPress VIP support and exclusion for UsingCustomConstant PHPCS rule (props [@barryceelen](https://github.com/barryceelen) via [#30](https://github.com/10up/Ad-Refresh-Control/pull/30)).

### Changed
- Webpack config to use CoreJS 3 instead of 2 to handle ES7 polyfills (props [@davidrgreen](https://github.com/davidrgreen) via [#31](https://github.com/10up/Ad-Refresh-Control/pull/31)).

### Removed
- Unused namespace abstraction function (props [@barryceelen](https://github.com/barryceelen) via [#28](https://github.com/10up/Ad-Refresh-Control/pull/28), [#29](https://github.com/10up/Ad-Refresh-Control/pull/29)).

### Fixed
- Add check that explicitly verifies that `disable_refresh` is `true` before saving the setting (props [@barryceelen](https://github.com/barryceelen) via [#27](https://github.com/10up/Ad-Refresh-Control/pull/27)).

### Security
- Bump `dot-prop` from 4.2.0 to 4.2.1 (props [@dependabot](https://github.com/apps/dependabot) via [#23](https://github.com/10up/Ad-Refresh-Control/pull/23)).

## [1.0.1] - 2020-09-30
### Added
- Plugin header and icon images (props [@JackieKjome](https://github.com/JackieKjome) via [#16](https://github.com/10up/Ad-Refresh-Control/pull/16)).
- GitHub Actions for deploys to WordPress.org (props [@jeffpaul](https://github.com/jeffpaul) via [#16](https://github.com/10up/Ad-Refresh-Control/pull/16)).
- Documentation updates (props [@jeffpaul](https://github.com/jeffpaul) via [#10](https://github.com/10up/Ad-Refresh-Control/pull/10), [#11](https://github.com/10up/Ad-Refresh-Control/pull/11), [#16](https://github.com/10up/Ad-Refresh-Control/pull/16)).

### Security
- Bump `lodash` from 4.17.15 to 4.17.19 (props [@dependabot](https://github.com/apps/dependabot) via [#12](https://github.com/10up/Ad-Refresh-Control/pull/12)).
- Bump `elliptic` from 6.4.1 to 6.5.3 (props [@dependabot](https://github.com/apps/dependabot) via [#13](https://github.com/10up/Ad-Refresh-Control/pull/13)).

## [1.0.0] - 2020-06-10
### Added
- Initial public release! 🎉

[Unreleased]: https://github.com/10up/Ad-Refresh-Control/compare/trunk...develop
[1.0.5]: https://github.com/10up/Ad-Refresh-Control/compare/1.0.4...1.0.5
[1.0.4]: https://github.com/10up/Ad-Refresh-Control/compare/1.0.3...1.0.4
[1.0.3]: https://github.com/10up/Ad-Refresh-Control/compare/1.0.2...1.0.3
[1.0.2]: https://github.com/10up/Ad-Refresh-Control/compare/1.0.1...1.0.2
[1.0.1]: https://github.com/10up/Ad-Refresh-Control/compare/v1.0.0...1.0.1
[1.0.0]: https://github.com/10up/Ad-Refresh-Control/releases/tag/v1.0.0
