# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Fixed - 2025-11-06
- Restored the compact newline-delimited `showDetails` inline script so consuming projects that embed the shared core no longer ship the verbose debug helper that triggers `Unexpected end of input` errors when Vercel truncates the minified output.

### Fixed - 2025-11-03
- Suppressed duplicate mission log rows for pilots that performed takeoff/landing cycles under two minutes with no intervening actions by introducing `deduplicateShortFlightSegments()` and matching airport checks during event normalization.

### Changed - 2025-11-03
- Renamed the pilot statistics "Targets Destroyed" column to "Airframes Lost" and synced the wording across English, Russian, and Ukrainian language packs so airframe loss totals read consistently in every UI bundle.

### Added - 2025-11-04
- Added MQ-1 Predator, SA 342L Gazelle, MiG-27K Flogger-J2, and Wing Loong I icon entries (with licensing metadata) to the manifest, normalized their 640x360 thumbnails, and taught the auto-curation script the new airframe aliases to keep automated fetches comprehensive.

### Added - 2025-11-02
- Introduced `disconnects`, `confidence`, and `sources` strings across all localized language packs so the new mission statistics columns render with translated labels.

### Changed - 2025-11-02
- Styled the mission timeline confidence and source columns with centered alignment and pill badges to keep the numeric-only evidence counts legible.
- Offset disconnect annotations by the mission start time so per-pilot disconnect summaries display the aligned timeline values.

### Added - 2025-10-31
- Added `resolveCategoryIcon()` to provide coalition-aware fallbacks for missing building sprites when rendering Tacview event logs.

### Changed - 2025-10-31
- Updated the event log renderer to call `resolveCategoryIcon()` so the HTML output gracefully handles absent category icon files instead of referencing missing assets.
