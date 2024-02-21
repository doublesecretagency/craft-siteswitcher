# Changelog

## Unreleased

### Changed
- Craft 5 compatibility.

## 2.3.0 - 2022-03-29

### Added
- Craft 4 compatibility.

## 2.2.0 - 2020-12-01

### Added
- Optionally fall back to the translated homepage when a link cannot otherwise be determined. (thanks @niektenhoopen)

### Changed
- Updated deprecated Twig references.

## 2.1.0 - 2019-04-20

### Added
- Added instructions for "Checking whether a translated element exists".

### Fixed
- Fixed bug which provided incorrect links on static pages.
- Ensures query string parameters persist between sites.

## 2.0.0 - 2018-08-30

### Added
- Craft 3 compatibility.
- Added `siteSwitcher` Twig function shortcut.

### Changed
- Changed name to "Site Switcher".
- Deprecated `ll` Twig function shortcut.

## 1.2.0 - 2015-12-01

### Added
- Craft 2.5 compatibility.

### Fixed
- Fixed `siteUrl` trailing slash issue.

## 1.1.0 - 2015-08-11

### Added
- Added `ll` Twig function shortcut.

### Changed
- Improved URL parsing.
- Keep trailing slash in mind when building new URL.

## 1.0.1 - 2015-03-16

### Fixed
- Gracefully fails if `siteUrl` is not an array.

## 1.0.0 - 2015-03-08

Initial release.
