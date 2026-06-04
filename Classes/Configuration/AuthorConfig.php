<?php

declare(strict_types=1);

namespace MarekSkopal\MsRecipe\Configuration;

final readonly class AuthorConfig
{
    public function __construct(public string $name = '', public string $url = '',)
    {
    }
}
