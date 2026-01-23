<?php

declare(strict_types=1);

namespace MarekSkopal\MsRecipe\Domain\Model;

use Stringable;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class InstructionSection extends AbstractEntity implements Stringable
{
    protected string $title = '';

    /** @var ObjectStorage<Instruction> */
    protected ObjectStorage $instructions;

    public function __construct()
    {
        $this->initializeObject();
    }

    public function initializeObject(): void
    {
        $this->instructions = new ObjectStorage();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /** @return ObjectStorage<Instruction> */
    public function getInstructions(): ObjectStorage
    {
        return $this->instructions;
    }

    /** @param ObjectStorage<Instruction> $instructions */
    public function setInstructions(ObjectStorage $instructions): void
    {
        $this->instructions = $instructions;
    }
}
