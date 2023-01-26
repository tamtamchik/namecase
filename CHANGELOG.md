# Changelog

All Notable changes to `tamtamchik/namecase` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## 3.0.0 - 2023-01-26

**Breaking Change!** Minimum PHP version is now 7.3.

### Added

- Namespaced function `Tamtamchik\NameCase\str_name_case` and tests.

## 2.3.0 – 2021-02-20

### Added

* Support for lowercase words The, Of, And ([#17](https://github.com/tamtamchik/namecase/issues/17)) 

## 2.2.0 – 2021-01-15

### Added

* PHP 8 support.

## 2.1.1 – 2020-03-05

### Added

* Fix missing end word boundary on `ten`, `ter` Dutch/Flemish (#9).

## 2.1.0 – 2020-02-07

### Added

* `excludePostNominals` method to add excluded values (#7).

## 2.0.1 – 2020-02-07

### Added

* `MBE` post-nominal.

## 2.0.0 - 2019-07-17

### Breaking changes

* Dropped support for `PHP < 7.2`
* Dropped support for global function `str_name_case`
* `spanish` option is now `false` by default.

### Added
* Post-nominals detection. 

* Constructor now supports `options` parameter.
* Added options:
  - `lazy` – Default: **true**. Do not do anything if the string is already mixed case and the lazy option is `true`.
  - `irish` – Default: **true**. Correct `Mac`.
  - `spanish` – Default: **false**. Corrects `el, la` and Spanish conjunctions.
  - `roman` – Default: **true**. Corrects roman numbers.
  - `hebrew` – Default: **true**. Corrects `ben, bat`.
  - `postnominal` – Default: **true**. Corrects post-nominals.

### Updated
* New irish `Mac` exceptions. 

## 1.0.6 - 2019-05-24

### Fixed

* Fix missing end word boundary on `ten`, `ter` Dutch/Flemish (#9).

## 1.0.5 - 2019-07-16

### Added
- Dutch: `ter/ten` (#6) thx, @MagicLegend

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
