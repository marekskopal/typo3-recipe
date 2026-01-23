<?php

declare(strict_types=1);

namespace MarekSkopal\MsRecipe\Domain\Model;

use Stringable;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Ingredient extends AbstractEntity implements Stringable
{
    protected string $ingredient = '';

    public function getIngredient(): string
    {
        return $this->ingredient;
    }

    public function setIngredient(string $ingredient): void
    {
        $this->ingredient = $ingredient;
    }
}
