<?php

namespace MarekSkopal\MsRecipe\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
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
 * Instruction section model
 * @package MarekSkopal\MsRecipe\Domain\Model
 */
class InstructionSection extends AbstractEntity
{
    protected string $title;

    /** @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\MarekSkopal\MsRecipe\Domain\Model\Instruction> */
    protected ObjectStorage $instructions;

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
     * @return ObjectStorage<\MarekSkopal\MsRecipe\Domain\Model\Instruction>|Instruction[]
     */
    public function getInstructions(): ObjectStorage
    {
        return $this->instructions;
    }

    /**
     * @param ObjectStorage<\MarekSkopal\MsRecipe\Domain\Model\Instruction> $instructions
     */
    public function setInstructions(ObjectStorage $instructions): void
    {
        $this->instructions = $instructions;
    }
}
