<?php

namespace MarekSkopal\MsRecipe\Domain\Model;

use GeorgRinger\News\Domain\Model\FileReference;
use GeorgRinger\News\Domain\Model\News;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2023 Marek Skopal <skopal.marek@gmail.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Recipe model
 * @package MarekSkopal\MsRecipe\Domain\Model
 */
class Recipe extends News
{
    protected ?string $nutritionYield = null;

    protected int $nutritionCalories;

    protected int $nutritionProteins;

    protected int $nutritionCarbs;

    protected int $nutritionFats;

    protected int $nutritionFiber;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\MarekSkopal\MsRecipe\Domain\Model\IngredientSection>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected ObjectStorage $ingredientSections;

    protected ?string $ingredientText = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\MarekSkopal\MsRecipe\Domain\Model\InstructionSection>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected ObjectStorage $instructionSections;

    protected ?string $instructionText = null;

    /**
     * @return string|null
     */
    public function getNutritionYield(): ?string
    {
        return $this->nutritionYield;
    }

    /**
     * @param string $nutritionYield|null
     */
    public function setNutritionYield(?string $nutritionYield): void
    {
        $this->nutritionYield = $nutritionYield;
    }

    /**
     * @return int
     */
    public function getNutritionCalories(): int
    {
        return $this->nutritionCalories;
    }

    /**
     * @param int $nutritionCalories
     */
    public function setNutritionCalories(int $nutritionCalories): void
    {
        $this->nutritionCalories = $nutritionCalories;
    }

    /**
     * @return int
     */
    public function getNutritionProteins(): int
    {
        return $this->nutritionProteins;
    }

    /**
     * @param int $nutritionProteins
     */
    public function setNutritionProteins(int $nutritionProteins): void
    {
        $this->nutritionProteins = $nutritionProteins;
    }

    /**
     * @return int
     */
    public function getNutritionCarbs(): int
    {
        return $this->nutritionCarbs;
    }

    /**
     * @param int $nutritionCarbs
     */
    public function setNutritionCarbs(int $nutritionCarbs): void
    {
        $this->nutritionCarbs = $nutritionCarbs;
    }

    /**
     * @return int
     */
    public function getNutritionFats(): int
    {
        return $this->nutritionFats;
    }

    /**
     * @param int $nutritionFats
     */
    public function setNutritionFats(int $nutritionFats): void
    {
        $this->nutritionFats = $nutritionFats;
    }

    /**
     * @return ObjectStorage<\MarekSkopal\MsRecipe\Domain\Model\IngredientSection>|IngredientSection[]
     */
    public function getIngredientSections(): ObjectStorage
    {
        return $this->ingredientSections;
    }

    /**
     * @param ObjectStorage<\MarekSkopal\MsRecipe\Domain\Model\IngredientSection> $ingredientSections
     */
    public function setIngredientSections(ObjectStorage $ingredientSections): void
    {
        $this->ingredientSections = $ingredientSections;
    }

    /**
     * @return string|null
     */
    public function getIngredientText(): ?string
    {
        return $this->ingredientText;
    }

    /**
     * @param string|null $ingredientText
     */
    public function setIngredientText(?string $ingredientText): void
    {
        $this->ingredientText = $ingredientText;
    }

    /**
     * @return ObjectStorage<\MarekSkopal\MsRecipe\Domain\Model\InstructionSection>|InstructionSection[]
     */
    public function getInstructionSections(): ObjectStorage
    {
        return $this->instructionSections;
    }

    /**
     * @param ObjectStorage<\MarekSkopal\MsRecipe\Domain\Model\InstructionSection> $instructionSections
     */
    public function setInstructionSections(ObjectStorage $instructionSections): void
    {
        $this->instructionSections = $instructionSections;
    }

    /**
     * @return string|null
     */
    public function getInstructionText(): ?string
    {
        return $this->instructionText;
    }

    /**
     * @param string|null $instructionText
     */
    public function setInstructionText(?string $instructionText): void
    {
        $this->instructionText = $instructionText;
    }

    /**
     * @return int
     */
    public function getNutritionFiber(): int
    {
        return $this->nutritionFiber;
    }

    /**
     * @param int $nutritionFiber
     */
    public function setNutritionFiber(int $nutritionFiber): void
    {
        $this->nutritionFiber = $nutritionFiber;
    }

    /**
     * Checks if has nutrition fields
     * @return bool
     */
    public function getHasNutrition(): bool
    {
        return !empty($this->nutritionCalories)
            || !empty($this->nutritionProteins)
            || !empty($this->nutritionCarbs)
            || !empty($this->nutritionFats)
            || !empty($this->nutritionFiber);
    }

    /**
     * Returns structured data
     * @return array<mixed>
     */
    public function getStructuredData(): array
    {
        $structuredData = [];

        $structuredData['@context'] = 'https://schema.org/';
        $structuredData['@type'] = 'Recipe';
        $structuredData['name'] = $this->getTitle();

        foreach ($this->getMediaPreviews() as $mediaPreview) {
            /** @var FileReference $mediaPreview */
            $structuredData['image'][] = $mediaPreview->getOriginalResource()->getPublicUrl();
        }

        $structuredData['author'] = [
            "@type" => "Person",
            "name" => "Marek Skopal",
        ];

        $structuredData['datePublished'] = $this->getDatetime()?->format('Y-m-d');

        $teaser = $this->getTeaser();
        if (!empty($teaser)) {
            $structuredData['description'] = $teaser;
        }

        $structuredData['keywords'] = $this->getKeywords();

        $nutritionYield = $this->getNutritionYield();
        if (!empty($nutritionYield)) {
            $structuredData['recipeYield'] = $nutritionYield;
        }

        $nutritionCalories = $this->getNutritionCalories();
        if (!empty($nutritionCalories)) {
            $structuredData['nutrition'] = [
                '@type' => 'NutritionInformation',
                'calories' => $nutritionCalories,
            ];
        }

        $ingredientSections = $this->getIngredientSections();
        if ($ingredientSections->count() > 0) {
            foreach ($ingredientSections as $ingredientSection) {
                foreach ($ingredientSection->getIngredients() as $ingredient) {
                    $structuredData['recipeIngredient'][] = $ingredient->getIngredient();
                }
            }
        }

        $instructionSections = $this->getInstructionSections();
        if ($instructionSections->count() > 0) {
            if ($instructionSections->count() === 1) {
                foreach ($instructionSections as $instructionSection) {
                    foreach ($instructionSection->getInstructions() as $instruction) {
                        $structuredData['recipeInstructions'][] = [
                            '@type' => 'HowToStep',
                            'text' => $instruction->getInstruction(),
                            //'url' => 'https://example.com/party-coffee-cake#step1',
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
                            //'url' => 'https://example.com/party-coffee-cake#step1',
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
}
