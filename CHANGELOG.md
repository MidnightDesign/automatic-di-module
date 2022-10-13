# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## 1.3.0 - 2022-10-11

### Added

- Nothing.

### Changed

- [#5](https://github.com/MidnightDesign/automatic-di-module/pull/5) removes the dependency on interop-container
  and requires `psr/container` instead. This change also requires a minimum version of `^3.11`
  of [`laminas/laminas-servicemanager`](https://github.com/laminas/laminas-servicemanager/releases/tag/3.11.0), which
  introduced a forward compatibility layer to replace interop-container.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 1.2.0 - 2021-05-14

### Added

- Nothing.

### Changed

- [#3](https://github.com/MidnightDesign/automatic-di-module/pull/3) adds compatibility for PHP 8.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 1.1.0 - 2020-11-16

### Added

- Nothing.

### Changed

- [#1](https://github.com/MidnightDesign/automatic-di-module/pull/1) migrates to Laminas

- [#1](https://github.com/MidnightDesign/automatic-di-module/pull/1) changes minimum PHP version to 7.4

### Deprecated

- Nothing.

### Removed

- [#1](https://github.com/MidnightDesign/automatic-di-module/pull/1) removes dependency on laminas-modulemanager

- [#1](https://github.com/MidnightDesign/automatic-di-module/pull/1) drops compatibility with laminas-servicemanager version 2

### Fixed

- Nothing.
