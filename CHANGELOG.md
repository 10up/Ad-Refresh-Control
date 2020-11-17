# Changelog

All notable changes to this project will be documented in this file, per [the Keep a Changelog standard](http://keepachangelog.com/), and will adhere to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased] - TBD

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
[1.0.2]: https://github.com/10up/Ad-Refresh-Control/compare/1.0.1...1.0.2
[1.0.1]: https://github.com/10up/Ad-Refresh-Control/compare/v1.0.0...1.0.1
[1.0.0]: https://github.com/10up/Ad-Refresh-Control/releases/tag/v1.0.0
