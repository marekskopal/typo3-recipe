# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Build & Quality Commands

```bash
# Install dependencies
composer install

# Static analysis (level max)
./vendor/bin/phpstan analyse

# Code style check (PSR-12 + Slevomat)
./vendor/bin/phpcs

# Auto-fix code style
./vendor/bin/phpcbf

# Run tests
./vendor/bin/phpunit
```

## Architecture

This is a TYPO3 CMS extension (`ms_recipe`) that adds a **Recipe** record type to `georgringer/news`. A recipe is a `tx_news` row with `type = 3` plus extra fields (ingredient sections, instruction sections, nutrition info, free-text ingredient/instruction blocks). The extension also emits schema.org `Recipe` JSON-LD structured data.

**Namespace:** `MarekSkopal\MsRecipe`

### Key Components

- **Recipe** (`Classes/Domain/Model/`) — extends `GeorgRinger\News\Domain\Model\News`, wired as a record-type subclass via `Configuration/Extbase/Persistence/Classes.php` and the TypoScript Set
- **IngredientSection / Ingredient / InstructionSection / Instruction** (`Classes/Domain/Model/`) — child models held by Recipe as `ObjectStorage`s
- **RecipeStructuredDataBuilder** (`Classes/Service/`) — builds the schema.org `Recipe` array (image, author, datePublished, recipeYield, nutrition, recipeIngredient, recipeInstructions with `HowToStep`/`HowToSection` depending on section count)
- **AuthorConfig / AuthorConfigProvider** (`Classes/Configuration/`, `Classes/Service/`) — reads `authorName` / `authorUrl` from the extension configuration; provider returns a default `AuthorConfig` when unconfigured
- **StructuredDataViewHelper** (`Classes/ViewHelpers/`) — Fluid VH `<r:structuredData recipe="…" />` that renders the JSON-LD `<script type="application/ld+json">` block

### TCA

- `Configuration/TCA/tx_msrecipe_domain_model_*.php` — ingredient(section) and instruction(section) tables
- `Configuration/TCA/Overrides/tx_news_domain_model_news.php` — adds the recipe palette to `tx_news_domain_model_news` and registers `type = 3` as **Recipe**, cloning the type-0 layout and appending the recipe palette after `bodytext`

### Templates

- `Resources/Private/Partials/Recipe/Detail.html` — drop-in partial rendering all recipe fields (ingredient sections, instruction sections, nutrition, JSON-LD). Render from a `tx_news` Detail template:
  ```html
  <f:if condition="{newsItem.type} == 3">
      <f:render partial="Recipe/Detail" arguments="{recipe: newsItem}" />
  </f:if>
  ```

### Configuration

- TypoScript Set **Recipe** (TYPO3 13+) in `Configuration/Sets/MsRecipe/` registers the Recipe subclass mapping and adds the recipe partial path to `plugin.tx_news.view.partialRootPaths`
- Extension configuration (`ext_conf_template.txt`) exposes `authorName` and `authorUrl` for the JSON-LD `author` block

## Requirements

- PHP 8.3+
- TYPO3 13.4 or 14.3+
- `georgringer/news` ^14.0

## Code Style

- Strict types enabled in all files
- **No constructor property promotion in Extbase domain models** — TYPO3 Extbase hydrates models by setting protected properties directly (bypassing the constructor), so properties must be declared classically with default values
- PHPStan level `max` with bleeding edge
- PSR-12 with Slevomat Coding Standard
