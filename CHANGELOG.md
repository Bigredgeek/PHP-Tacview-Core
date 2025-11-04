# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added - 2025-11-02
- Introduced `disconnects`, `confidence`, and `sources` strings across all localized language packs so the new mission statistics columns render with translated labels.

### Changed - 2025-11-02
- Styled the mission timeline confidence and source columns with centered alignment and pill badges to keep the numeric-only evidence counts legible.
- Offset disconnect annotations by the mission start time so per-pilot disconnect summaries display the aligned timeline values.

### Added - 2025-10-31
- Added `resolveCategoryIcon()` to provide coalition-aware fallbacks for missing building sprites when rendering Tacview event logs.

### Changed - 2025-10-31
- Updated the event log renderer to call `resolveCategoryIcon()` so the HTML output gracefully handles absent category icon files instead of referencing missing assets.
