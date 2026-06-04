<?php

declare(strict_types=1);

namespace MarekSkopal\MsRecipe\ViewHelpers;

use MarekSkopal\MsRecipe\Domain\Model\Recipe;
use MarekSkopal\MsRecipe\Service\RecipeStructuredDataBuilder;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use const JSON_UNESCAPED_SLASHES;
use const JSON_UNESCAPED_UNICODE;

/**
 * Renders a recipe as a JSON-LD <script> block (schema.org Recipe).
 *
 * ```
 *   <r:structuredData recipe="{newsItem}" />
 * ```
 */
final class StructuredDataViewHelper extends AbstractViewHelper
{
    /** @var bool */
    // phpcs:ignore SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
    protected $escapeChildren = false;

    /** @var bool */
    // phpcs:ignore SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
    protected $escapeOutput = false;

    public function __construct(private readonly RecipeStructuredDataBuilder $structuredDataBuilder)
    {
    }

    public function initializeArguments(): void
    {
        $this->registerArgument('recipe', Recipe::class, 'Recipe to render structured data for', true);
    }

    public function render(): string
    {
        $recipe = $this->arguments['recipe'];
        if (!$recipe instanceof Recipe) {
            return '';
        }

        $json = json_encode(
            $this->structuredDataBuilder->build($recipe),
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
        );
        if ($json === false) {
            return '';
        }

        return '<script type="application/ld+json">' . $json . '</script>';
    }
}
