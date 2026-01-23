<?php

declare(strict_types=1);

namespace MarekSkopal\MsRecipe\Domain\Model;

use Stringable;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Instruction extends AbstractEntity implements Stringable
{
    protected string $instruction = '';

    public function getInstruction(): string
    {
        return $this->instruction;
    }

    public function setInstruction(string $instruction): void
    {
        $this->instruction = $instruction;
    }
}
