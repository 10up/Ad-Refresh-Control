# Changelog

All notable changes to this project will be documented in this file, per [the Keep a Changelog standard](http://keepachangelog.com/), and will adhere to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased] - TBD

## [1.1.2] - 2023-05-31
### Changed
- Bump WordPress "tested up to" version 6.2 (props [@Sidsector9](https://github.com/Sidsector9), [@iamdharmesh](https://github.com/iamdharmesh) via [#110](https://github.com/10up/Ad-Refresh-Control/pull/110)).
- Documentation updates (props [@barryceelen](https://github.com/barryceelen), [@jeffpaul](https://github.com/jeffpaul) via [#104](https://github.com/10up/Ad-Refresh-Control/pull/104)).

### Security
- Bump `minimist` from 1.2.0 to 1.2.8 (props [@dependabot](https://github.com/apps/dependabot), [@cadic](https://github.com/cadic) via [#105](https://github.com/10up/Ad-Refresh-Control/pull/105)).
- Bump `mkdirp` from 0.5.1 to 0.5.6 (props [@dependabot](https://github.com/apps/dependabot), [@cadic](https://github.com/cadic) via [#105](https://github.com/10up/Ad-Refresh-Control/pull/105)).
- Bump `loader-fs-cache` from 1.0.2 to 1.0.3 (props [@dependabot](https://github.com/apps/dependabot), [@cadic](https://github.com/cadic) via [#105](https://github.com/10up/Ad-Refresh-Control/pull/105)).
- Bump `ua-parser-js` from 1.0.2 to 1.0.34 (props [@dependabot](https://github.com/apps/dependabot), [@cadic](https://github.com/cadic) via [#106](https://github.com/10up/Ad-Refresh-Control/pull/106)).
- Bump `browser-sync` from 2.27.10 to 2.28.3 (props [@dependabot](https://github.com/apps/dependabot), [@cadic](https://github.com/cadic) via [#106](https://github.com/10up/Ad-Refresh-Control/pull/106)).
- Bump `yaml` from 2.1.3 to 2.2.2 (props [@dependabot](https://github.com/apps/dependabot), [@faisal-alvi](https://github.com/faisal-alvi) via [#111](https://github.com/10up/Ad-Refresh-Control/pull/111)).
- Bump `json5` from 1.0.1 to 1.0.2 (props [@dependabot](https://github.com/apps/dependabot), [@peterwilsoncc](https://github.com/peterwilsoncc) via [#103](https://github.com/10up/Ad-Refresh-Control/pull/103)).
- Bump `socket.io-parser` from 4.2.2 to 4.2.3 (props [@dependabot](https://github.com/apps/dependabot), [@faisal-alvi](https://github.com/faisal-alvi) via [#112](https://github.com/10up/Ad-Refresh-Control/pull/112)).

## [1.1.1] - 2023-01-05
**Note that this release bumps the WordPress minimum version from 4.9 to 5.7 and the PHP minimum version from 7.0 to 7.4.**

### Added
- Release build GitHub Action (props [@dkotter](https://github.com/dkotter) via [#99](https://github.com/10up/Ad-Refresh-Control/pull/99)).

### Changed
- Bump WordPress minimum version from 4.9 to 5.7 and PHP minimum version from 7.0 to 7.4 (props [@jayedul](https://github.com/jayedul), [@dkotter](https://github.com/dkotter) via [#72](https://github.com/10up/Ad-Refresh-Control/pull/72)).
- Bump WordPress "tested up to" version to 6.1 (props [@jayedul](https://github.com/jayedul), [@dkotter](https://github.com/dkotter) via [#97](https://github.com/10up/Ad-Refresh-Control/pull/97)).
- [Support Level](https://github.com/10up/Ad-Refresh-Control#support-level) from `Active` to `Stable` (props [@jeffpaul](https://github.com/jeffpaul) via [#73](https://github.com/10up/Ad-Refresh-Control/pull/73)).

### Removed
- `simple-git` as it is no longer used after updating ancestor dependency `lint-staged` (props [@dependabot](https://github.com/apps/dependabot) via [#82](https://github.com/10up/Ad-Refresh-Control/pull/82)).
- `is-svg` as it is no longer used after updating ancestor dependency `postcss-svgo` (props [@dependabot](https://github.com/apps/dependabot) via [#88](https://github.com/10up/Ad-Refresh-Control/pull/88)).

### Fixed
- PHPCS workflow failures (props [@peterwilsoncc](https://github.com/peterwilsoncc), [@cadic](https://github.com/cadic) via [#84](https://github.com/10up/Ad-Refresh-Control/pull/84)).

### Security
- Bump `terser` from 3.17.0 to 4.8.1 (props [@dependabot](https://github.com/apps/dependabot) via [#71](https://github.com/10up/Ad-Refresh-Control/pull/71)).
- Bump `loader-utils` from 1.2.3 to 1.4.2 (props [@dependabot](https://github.com/apps/dependabot) via [#74](https://github.com/10up/Ad-Refresh-Control/pull/74)).
- Bump `minimatch` from 3.0.4 to 3.1.2 (props [@dependabot](https://github.com/apps/dependabot) via [#76](https://github.com/10up/Ad-Refresh-Control/pull/76)).
- Bump `engine.io` from 3.2.1 to 6.2.1 and `browser-sync` from 2.26.5 to 2.27.10 (props [@dependabot](https://github.com/apps/dependabot) via [#78](https://github.com/10up/Ad-Refresh-Control/pull/78), [#91](https://github.com/10up/Ad-Refresh-Control/pull/91)).
- Bump `postcss` from 7.0.14 to 8.4.19 and `postcss-preset-env` from 5.3.0 to 7.8.3 (props [@dependabot](https://github.com/apps/dependabot) via [#81](https://github.com/10up/Ad-Refresh-Control/pull/81)).
- Bump `lint-staged` from 8.1.5 to 13.0.3 (props [@dependabot](https://github.com/apps/dependabot) via [#82](https://github.com/10up/Ad-Refresh-Control/pull/82)).
- Bump `set-value` from 2.0.0 to 2.0.1 and `union-value` from 1.0.0 to 1.0.1 (props [@dependabot](https://github.com/apps/dependabot) via [#86](https://github.com/10up/Ad-Refresh-Control/pull/86)).
- Bump `yargs-parser` from 10.1.0 to 20.2.9, `stylelint` from 9.10.1 to 14.15.0, and `webpack-cli` from 3.3.1 to 3.3.12 (props [@dependabot](https://github.com/apps/dependabot) via [#87](https://github.com/10up/Ad-Refresh-Control/pull/87)).
- Bump `postcss-svgo` from 4.0.2 to 4.0.3 (props [@dependabot](https://github.com/apps/dependabot) via [#88](https://github.com/10up/Ad-Refresh-Control/pull/88)).
- Bump `nth-check` from 1.0.2 to 2.1.1 and `cssnano` from 4.1.10 to 5.1.14 (props [@dependabot](https://github.com/apps/dependabot) via [#89](https://github.com/10up/Ad-Refresh-Control/pull/89)).
- Bump `trim-newlines` from 2.0.0 to 3.0.1 and `stylelint-declaration-use-variable` from 1.7.0 to 1.7.3 (props [@dependabot](https://github.com/apps/dependabot) via [#93](https://github.com/10up/Ad-Refresh-Control/pull/93)).
- Bump `kind-of` from 6.0.2 to 6.0.3 (props [@dependabot](https://github.com/apps/dependabot) via [#94](https://github.com/10up/Ad-Refresh-Control/pull/94)).
- Bump `serialize-javascript` from 1.7.0 to 4.0.0, `copy-webpack-plugin` from 5.0.3 to 5.1.2, and `terser-webpack-plugin` from 1.2.3 to 1.4.5 (props [@dependabot](https://github.com/apps/dependabot) via [#95](https://github.com/10up/Ad-Refresh-Control/pull/95)).
- Bump `decode-uri-component` from 0.2.0 to 0.2.2 (props [@dependabot](https://github.com/apps/dependabot) via [#98](https://github.com/10up/Ad-Refresh-Control/pull/98)).

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
[1.1.2]: https://github.com/10up/Ad-Refresh-Control/compare/1.1.1...1.1.2
[1.1.1]: https://github.com/10up/Ad-Refresh-Control/compare/1.1.0...1.1.1
[1.1.0]: https://github.com/10up/Ad-Refresh-Control/compare/1.0.5...1.1.0
[1.0.5]: https://github.com/10up/Ad-Refresh-Control/compare/1.0.4...1.0.5
[1.0.4]: https://github.com/10up/Ad-Refresh-Control/compare/1.0.3...1.0.4
[1.0.3]: https://github.com/10up/Ad-Refresh-Control/compare/1.0.2...1.0.3
[1.0.2]: https://github.com/10up/Ad-Refresh-Control/compare/1.0.1...1.0.2
[1.0.1]: https://github.com/10up/Ad-Refresh-Control/compare/v1.0.0...1.0.1
[1.0.0]: https://github.com/10up/Ad-Refresh-Control/releases/tag/v1.0.0
