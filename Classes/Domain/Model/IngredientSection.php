<?php

declare(strict_types=1);

namespace MarekSkopal\MsRecipe\Domain\Model;

use Stringable;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class IngredientSection extends AbstractEntity implements Stringable
{
    protected string $title = '';

    protected string $bodytext = '';

    /** @var ObjectStorage<Ingredient> */
    protected ObjectStorage $ingredients;

    public function __construct()
    {
        $this->initializeObject();
    }

    public function initializeObject(): void
    {
        $this->ingredients = new ObjectStorage();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getBodytext(): string
    {
        return $this->bodytext;
    }

    public function setBodytext(string $bodytext): void
    {
        $this->bodytext = $bodytext;
    }

    /** @return ObjectStorage<Ingredient> */
    public function getIngredients(): ObjectStorage
    {
        return $this->ingredients;
    }

    /** @param ObjectStorage<Ingredient> $ingredients */
    public function setIngredients(ObjectStorage $ingredients): void
    {
        $this->ingredients = $ingredients;
    }
}
