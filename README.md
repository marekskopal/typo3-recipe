# Recipes for TYPO3 CMS

Adds a **Recipe** record type to `georgringer/news`. A recipe is a news item with the type **Recipe** that carries ingredient sections, instruction sections, nutrition information, and free-text fallback fields. The extension also emits schema.org `Recipe` JSON-LD structured data so search engines can render rich results.

## Features

- New **Recipe** record type for `tx_news` — adds the recipe palette to existing news with `type = 3`
- **Ingredient sections** with title, ingredient list, and optional bodytext
- **Instruction sections** with title and ordered instruction steps
- Free-text fallback **ingredient text** and **instruction text** (RTE)
- **Nutrition info** — yield, calories, proteins, carbs, fats, fiber
- Automatic **JSON-LD** (`Recipe` schema.org structured data) via a Fluid ViewHelper — emits `HowToStep` for single-section recipes and `HowToSection` for multi-section recipes
- Drop-in **Recipe Detail partial** that renders every recipe field
- Configurable **author** for the JSON-LD payload via the TYPO3 extension configuration
- Multilingual labels (EN, CS out of the box)
- TYPO3 13 and 14 compatible

## Examples

- [www.mlsnej.cz](https://www.mlsnej.cz)

## Requirements

- PHP 8.3+
- TYPO3 13.4 or 14.3+
- `georgringer/news` ^14.0

## Installation

```bash
composer require marekskopal/typo3-recipe
```

After installation, run the database analyser in the TYPO3 Install Tool to create the required tables.

## Setup

Include the TypoScript Set **Recipe** in your site package or via the site configuration sets. The Set wires the Recipe domain model as a `tx_news` subclass and exposes the partial path under `plugin.tx_news.view.partialRootPaths`.

## Backend Setup

Create or edit a news record on a page where the **News** content element is placed. Switch the **Type** to **Recipe** and fill in the recipe palette:

- **Ingredient sections** — inline children with title, ingredient list, and optional bodytext
- **Ingredient text** — RTE fallback shown after ingredient sections
- **Instruction sections** — inline children with title and ordered instructions
- **Instruction text** — RTE fallback shown after instruction sections
- **Yield** — e.g. `4 servings` (used as `recipeYield`)
- **Calories / Proteins / Carbs / Fats / Fiber** — nutrition values (integers; calories drive the JSON-LD `NutritionInformation` block)

## Rendering the recipe

The extension ships `Resources/Private/Partials/Recipe/Detail.html` and registers its path on `plugin.tx_news.view.partialRootPaths`. Render it from your `tx_news` Detail template:

```html
<f:if condition="{newsItem.type} == 3">
    <f:render partial="Recipe/Detail" arguments="{recipe: newsItem}" />
</f:if>
```

The partial renders ingredient sections, instruction sections, nutrition table, optional RTE fallbacks, and emits the JSON-LD block using the ViewHelper below.

## JSON-LD ViewHelper

The Fluid ViewHelper `<r:structuredData recipe="{recipe}" />` outputs a `<script type="application/ld+json">` block with schema.org `Recipe` structured data. Register the namespace at the top of a template:

```html
<html xmlns:r="http://typo3.org/ns/MarekSkopal/MsRecipe/ViewHelpers" data-namespace-typo3-fluid="true">
```

The structured data includes `name`, `image`, `author`, `datePublished`, `description`, `keywords`, `recipeYield`, `nutrition`, `recipeIngredient`, and `recipeInstructions` (using `HowToStep` for a single instruction section, or `HowToSection` when multiple sections exist).

## Author Configuration

Configure the `author` block of the JSON-LD payload in the extension configuration (Admin Tools → Settings → Extension Configuration → `ms_recipe`):

| Key | Description |
|-----|-------------|
| `authorName` | Author name. Empty value omits the `author` field from the JSON-LD output. |
| `authorUrl`  | Optional author URL — written as `author.url` when set. |

## Customization

### Templates

Override the bundled partial by adding your own path with a higher index:

```typoscript
plugin.tx_news.view.partialRootPaths.500 = EXT:your_extension/Resources/Private/Partials/
```

Then provide a `Recipe/Detail.html` in that directory.

### Styling

The bundled partial renders semantic markup (`<ul>` for ingredients, `<ol>` for instructions) without bundled CSS. Style the `.recipe`, `.recipe-ingredients`, `.recipe-instructions`, and `.recipe-nutrition` wrappers from your own site CSS.

## License

GPL-2.0-or-later
