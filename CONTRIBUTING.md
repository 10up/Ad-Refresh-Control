# Contributing and Maintaining

First, thank you for taking the time to contribute!

The following is a set of guidelines for contributors as well as information and instructions around our maintenance process. The two are closely tied together in terms of how we all work together and set expectations, so while you may not need to know everything in here to submit an issue or pull request, it's best to keep them in the same document.

## Ways to contribute

Contributing isn't just writing code - it's anything that improves the project. All contributions for Ad Refresh Control are managed right here on GitHub. Here are some ways you can help:

### Reporting bugs

If you're running into an issue with the plugin, please take a look through [existing issues](/issues) and [open a new one](/issues/new) if needed. If you're able, include steps to reproduce, environment information, and screenshots/screencasts as relevant.

### Suggesting enhancements

New features and enhancements are also managed via [issues](/issues).

### Pull requests

Pull requests represent a proposed solution to a specified problem. They should always reference an issue that describes the problem and contains discussion about the problem itself. Discussion on pull requests should be limited to the pull request itself, i.e. code review.

For more on how 10up writes and manages code, check out our [10up Engineering Best Practices](https://10up.github.io/Engineering-Best-Practices/).

## Workflow

The `develop` branch is the development branch which means it contains the next version to be released. `master` contains the current latest release. Always work on the `develop` branch and open up PRs against `develop`.

## Release instructions

1. Branch: Starting from `develop`, cut a release branch named `release/X.Y.Z` for your changes.
2. Version bump: Bump the version number in `ad-refresh-control.php`, `ad-refresh-control.pot`, `composer.json`, `package.json`, and `readme.txt` if it does not already reflect the version being released.  In `ad-refresh-control.php` update both the plugin "Version:" property and the plugin `AD_REFRESH_CONTROL_VERSION` constant.
3. Changelog: Add/update the changelog in both `CHANGELOG.md` and `readme.txt`.
4. Props: Update `CREDITS.md` file with any new contributors, confirm maintainers are accurate.
5. Readme updates: Make any other readme changes as necessary.  `README.md` is geared toward GitHub and `readme.txt` contains WordPress.org-specific content.  The two are slightly different.
6. New files: Check to be sure any new files/paths that are unnecessary in the production version are included in `.gitattributes`.
7. Merge: Make a non-fast-forward merge from your release branch to `develop` (or merge the pull request), then do the same for `develop` into `master` (`git checkout master && git merge --no-ff develop`).  `master` contains the stable development version.
8. Test: While still on the `master` branch, test for functionality locally.
9. Push: Push your `master` branch to GitHub (e.g. `git push origin master`).
10. Release: Create a [new release](/releases/new), naming the tag and the release with the new version number, and targeting the `master` branch.  Paste the changelog from `CHANGELOG.md` into the body of the release and include a link to the closed issues on the milestone (e.g. `https://github.com/10up/ad-refresh-control/milestone/#?closed=1`).
11. Version bump (again): In the `develop` branch (`cd ../ && git checkout develop`) bump the version number in `ad-refresh-control.php`, `ad-refresh-contorl.pot`, `composer.json`, `package.json`, and `readme.txt` to `X.Y.(Z+1)-dev`.  It's okay if the next release might be a different version number; that change can be handled right before release in the first step, as might also be the case with `@since` annotations.
12. SVN: Wait for the [GitHub Action](/actions) to finish deploying to the WordPress.org repository.  If all goes well, users with SVN commit access for that plugin will receive an emailed diff of changes.
13. Check WordPress.org: Ensure that the changes are live on https://wordpress.org/plugins/ad-refresh-control/. This may take a few minutes.
14. Close milestone: Edit the [X.Y.Z milestone](/milestone/#) with release date (in the `Due date (optional)` field) and link to GitHub release (in the `Description` field), then close the milestone.
15. Punt incomplete items: If any open issues or PRs which were milestoned for `X.Y.Z` do not make it into the release, update their milestone to `X.Y.Z+1`, `X.Y+1.0`, `X+1.0.0` or `Future Release`.
