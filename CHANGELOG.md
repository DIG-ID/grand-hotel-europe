# Changelog

All notable changes to this theme are documented in this file.
The format follows [Keep a Changelog](https://keepachangelog.com/en/1.1.0/)
and this project adheres to [Semantic Versioning](https://semver.org/).

The changelog starts at 1.1.0; earlier history is in git.

## [1.2.0] — 2026-11-16

### Added
- Homepage offer section: optional self-hosted video (new ACF field `section_offer_video`, MP4). It starts paused on the section image; the visitor's click plays it with sound, with custom player controls (play/pause, seek, time, mute + volume fader, fullscreen). Without a video the section shows the image as before.

## [1.1.0] — 2026-11-16

### Added
- Homepage: new "Offer" section (Weihnachtsangebot) between Restaurant & Bar and the outro, with its ACF field group (`group_section_offer`) kept in `acf-json/`.
- Theme helpers `ghe_text()` and `ghe_module_field()` (`inc/helpers.php`).
- ACF Local JSON for new field groups only (`inc/acf-json.php`); existing groups stay in the database.
- Project documentation and tooling: `CLAUDE.md`, `.claude/` (coding rules, agents, deploy/release skills), `NOTES.txt`.

### Changed
- PHPCS config recognises `ghe_text()` as an escaping function.
