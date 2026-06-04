# Changelog

All notable changes to `ms_recipe` are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.1.0] - 2026-06-04

### Added

- TYPO3 v14 support — `composer.json` and `ext_emconf.php` now accept TYPO3 13.4 LTS or 14.3+.
- `RecipeStructuredDataBuilder` service that produces the schema.org `Recipe` payload, extracted from the previous `Recipe::getStructuredData()` method.
- `StructuredDataViewHelper` (`<r:structuredData recipe="…" />`) that renders a JSON-LD `<script>` block for a recipe.
- `AuthorConfig` DTO and `AuthorConfigProvider` service that read `authorName` and `authorUrl` from the extension configuration and feed the JSON-LD `author` block.
- `ext_conf_template.txt` exposing the new `authorName` and `authorUrl` settings.
- Drop-in `Resources/Private/Partials/Recipe/Detail.html` rendering every recipe field (ingredient sections + free-text fallback, instruction sections + free-text fallback, nutrition table, JSON-LD).
- TypoScript Set wires the partial path into `plugin.tx_news.view.partialRootPaths`.
- English and Czech language labels for the new template strings (`Resources/Private/Language/locallang.xlf` + `cs.locallang.xlf`).
- Unit test suite (`Tests/Unit/Service/`) covering the structured data builder and the author config provider — 13 tests / 30 assertions.
- GitHub Actions CI matrix: PHPStan on PHP 8.3/8.4, PHPCS on PHP 8.3, PHPUnit on PHP 8.3/8.4 against TYPO3 ^13.4 and ^14.3.
- `CLAUDE.md` and a full `README.md` aligned with the sibling `marekskopal/typo3-*` extensions.

### Changed

- `Recipe::getStructuredData()` removed — render the JSON-LD via the new `<r:structuredData />` ViewHelper or call `RecipeStructuredDataBuilder::build()` directly.
- TCA cleanup: removed deprecated `dividers2tabs` and `interface => []` keys from the recipe domain model TCA (no-op on v13, removed in v14).
- `ruleset.xml` synced with sibling projects (PHP target 8.3, dropped `Squiz.Operators.ValidLogicalOperators`).

### Requirements

- PHP 8.3 or newer.
- TYPO3 13.4 LTS or 14.3+.
- `georgringer/news` ^14.0.

## [2.0.0] - 2026-01-23

- Initial TYPO3 v13 release.

[2.1.0]: https://github.com/marekskopal/typo3-recipe/releases/tag/v2.1.0
[2.0.0]: https://github.com/marekskopal/typo3-recipe/releases/tag/v2.0.0
