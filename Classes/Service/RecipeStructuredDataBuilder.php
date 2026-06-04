<?php

declare(strict_types=1);

namespace MarekSkopal\MsRecipe\Service;

use GeorgRinger\News\Domain\Model\FileReference;
use MarekSkopal\MsRecipe\Domain\Model\Recipe;

class RecipeStructuredDataBuilder
{
    public function __construct(private readonly AuthorConfigProvider $authorConfigProvider)
    {
    }

    /** @return array<string, mixed> */
    public function build(Recipe $recipe): array
    {
        $structuredData = [
            '@context' => 'https://schema.org/',
            '@type' => 'Recipe',
            'name' => $recipe->getTitle(),
        ];

        foreach ($recipe->getMediaPreviews() as $mediaPreview) {
            /** @var FileReference $mediaPreview */
            $structuredData['image'][] = $mediaPreview->getOriginalResource()->getPublicUrl();
        }

        $author = $this->buildAuthor();
        if ($author !== null) {
            $structuredData['author'] = $author;
        }

        $structuredData['datePublished'] = $recipe->getDatetime()?->format('Y-m-d');

        $teaser = $recipe->getTeaser();
        if ($teaser !== '') {
            $structuredData['description'] = $teaser;
        }

        $structuredData['keywords'] = $recipe->getKeywords();

        $nutritionYield = $recipe->getNutritionYield();
        if ($nutritionYield !== null && $nutritionYield !== '') {
            $structuredData['recipeYield'] = $nutritionYield;
        }

        $nutritionCalories = $recipe->getNutritionCalories();
        if ($nutritionCalories > 0) {
            $structuredData['nutrition'] = [
                '@type' => 'NutritionInformation',
                'calories' => $nutritionCalories,
            ];
        }

        $ingredientSections = $recipe->getIngredientSections();
        if ($ingredientSections->count() > 0) {
            foreach ($ingredientSections as $ingredientSection) {
                foreach ($ingredientSection->getIngredients() as $ingredient) {
                    $structuredData['recipeIngredient'][] = $ingredient->getIngredient();
                }
            }
        }

        $instructionSections = $recipe->getInstructionSections();
        if ($instructionSections->count() > 0) {
            if ($instructionSections->count() === 1) {
                foreach ($instructionSections as $instructionSection) {
                    foreach ($instructionSection->getInstructions() as $instruction) {
                        $structuredData['recipeInstructions'][] = [
                            '@type' => 'HowToStep',
                            'text' => $instruction->getInstruction(),
                        ];
                    }
                }
            } else {
                foreach ($instructionSections as $instructionSection) {
                    $howToSteps = [];

                    foreach ($instructionSection->getInstructions() as $instruction) {
                        $howToSteps[] = [
                            '@type' => 'HowToStep',
                            'text' => $instruction->getInstruction(),
                        ];
                    }

                    $structuredData['recipeInstructions'][] = [
                        '@type' => 'HowToSection',
                        'name' => $instructionSection->getTitle(),
                        'itemListElement' => $howToSteps,
                    ];
                }
            }
        }

        return $structuredData;
    }

    /** @return array<string, string>|null */
    private function buildAuthor(): ?array
    {
        $authorConfig = $this->authorConfigProvider->get();

        if ($authorConfig->name === '') {
            return null;
        }

        $author = [
            '@type' => 'Person',
            'name' => $authorConfig->name,
        ];

        if ($authorConfig->url !== '') {
            $author['url'] = $authorConfig->url;
        }

        return $author;
    }
}
