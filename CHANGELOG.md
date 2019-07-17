# Changelog

All Notable changes to `tamtamchik/namecase` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## 2.0.0-alpha - 2019-07-17

### Breaking changes:
* Dropped support for `PHP < 7.2`
* Dropped support for global function `str_name_case`
* `spanish` option is now `false` by default.

## Added
* Constructor now supports options.
* Added `roman` option.
* Added `postnominal` option.
* Added `hebrew` option.
* Extended Irish `Mac` exceptions. 

## 1.0.5 - 2019-07-16

### Added
- Dutch: `ter/ten` (thx, @MagicLegend)

## 1.0.4 - 2019-05-24

### Fixed
- Add `ext-mbstring` to composer.json

## 1.0.3 - 2018-09-12

### Fixed
- "empty string" warning 

## 1.0.2 - 2016-02-06

### Added
- Dutch: `den` (thx, @nexxai) 

## 1.0.1 - 2016-01-30

### Added
- static call
- instantiation
- tests

## 1.0.0 - 2016-01-29

Initial release.
