<?php

declare(strict_types=1);

namespace MarekSkopal\MsRecipe\Domain\Model;

use GeorgRinger\News\Domain\Model\News;
use Stringable;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Recipe extends News implements Stringable
{
    protected ?string $nutritionYield = null;

    protected int $nutritionCalories = 0;

    protected int $nutritionProteins = 0;

    protected int $nutritionCarbs = 0;

    protected int $nutritionFats = 0;

    protected int $nutritionFiber = 0;

    /** @var ObjectStorage<IngredientSection> */
    #[Lazy()]
    protected ObjectStorage $ingredientSections;

    protected ?string $ingredientText = null;

    /** @var ObjectStorage<InstructionSection> */
    #[Lazy()]
    protected ObjectStorage $instructionSections;

    protected ?string $instructionText = null;

    public function __construct()
    {
        parent::__construct();

        $this->initializeObject();
    }

    public function initializeObject(): void
    {
        parent::initializeObject();

        $this->ingredientSections = new ObjectStorage();
        $this->instructionSections = new ObjectStorage();
    }

    public function getNutritionYield(): ?string
    {
        return $this->nutritionYield;
    }

    public function setNutritionYield(?string $nutritionYield): void
    {
        $this->nutritionYield = $nutritionYield;
    }

    public function getNutritionCalories(): int
    {
        return $this->nutritionCalories;
    }

    public function setNutritionCalories(int $nutritionCalories): void
    {
        $this->nutritionCalories = $nutritionCalories;
    }

    public function getNutritionProteins(): int
    {
        return $this->nutritionProteins;
    }

    public function setNutritionProteins(int $nutritionProteins): void
    {
        $this->nutritionProteins = $nutritionProteins;
    }

    public function getNutritionCarbs(): int
    {
        return $this->nutritionCarbs;
    }

    public function setNutritionCarbs(int $nutritionCarbs): void
    {
        $this->nutritionCarbs = $nutritionCarbs;
    }

    public function getNutritionFats(): int
    {
        return $this->nutritionFats;
    }

    public function setNutritionFats(int $nutritionFats): void
    {
        $this->nutritionFats = $nutritionFats;
    }

    /** @return ObjectStorage<IngredientSection> */
    public function getIngredientSections(): ObjectStorage
    {
        return $this->ingredientSections;
    }

    /** @param ObjectStorage<IngredientSection> $ingredientSections */
    public function setIngredientSections(ObjectStorage $ingredientSections): void
    {
        $this->ingredientSections = $ingredientSections;
    }

    public function getIngredientText(): ?string
    {
        return $this->ingredientText;
    }

    public function setIngredientText(?string $ingredientText): void
    {
        $this->ingredientText = $ingredientText;
    }

    /** @return ObjectStorage<InstructionSection> */
    public function getInstructionSections(): ObjectStorage
    {
        return $this->instructionSections;
    }

    /** @param ObjectStorage<InstructionSection> $instructionSections */
    public function setInstructionSections(ObjectStorage $instructionSections): void
    {
        $this->instructionSections = $instructionSections;
    }

    public function getInstructionText(): ?string
    {
        return $this->instructionText;
    }

    public function setInstructionText(?string $instructionText): void
    {
        $this->instructionText = $instructionText;
    }

    public function getNutritionFiber(): int
    {
        return $this->nutritionFiber;
    }

    public function setNutritionFiber(int $nutritionFiber): void
    {
        $this->nutritionFiber = $nutritionFiber;
    }

    public function getHasNutrition(): bool
    {
        return $this->nutritionCalories !== 0
            || $this->nutritionProteins !== 0
            || $this->nutritionCarbs !== 0
            || $this->nutritionFats !== 0
            || $this->nutritionFiber !== 0;
    }
}
