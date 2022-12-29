<?php

namespace MarekSkopal\MsRecipe\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2020 Marek Skopal <skopal.marek@gmail.com>
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
 * Instruction section model
 * @package MarekSkopal\MsRecipe\Domain\Model
 */
class IngredientSection extends AbstractEntity
{
    protected string $title;

    protected string $bodytext;

    /** @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\MarekSkopal\MsRecipe\Domain\Model\Ingredient> */
    protected ObjectStorage $ingredients;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getBodytext(): string
    {
        return $this->bodytext;
    }

    /**
     * @param string $bodytext
     */
    public function setBodytext(string $bodytext): void
    {
        $this->bodytext = $bodytext;
    }

    /**
     * @return ObjectStorage<\MarekSkopal\MsRecipe\Domain\Model\Ingredient>|Ingredient[]
     */
    public function getIngredients(): ObjectStorage
    {
        return $this->ingredients;
    }

    /**
     * @param ObjectStorage<\MarekSkopal\MsRecipe\Domain\Model\Ingredient> $ingredients
     */
    public function setIngredients(ObjectStorage $ingredients): void
    {
        $this->ingredients = $ingredients;
    }
}
