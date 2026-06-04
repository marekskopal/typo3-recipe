<?php

declare(strict_types=1);

namespace MarekSkopal\MsRecipe\Service;

use MarekSkopal\MsRecipe\Configuration\AuthorConfig;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationPathDoesNotExistException;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;

class AuthorConfigProvider
{
    private const EXTENSION_KEY = 'ms_recipe';

    public function __construct(private readonly ExtensionConfiguration $extensionConfiguration)
    {
    }

    public function get(): AuthorConfig
    {
        $defaults = new AuthorConfig();

        return new AuthorConfig(
            name: $this->readString('authorName', $defaults->name),
            url: $this->readString('authorUrl', $defaults->url),
        );
    }

    private function readString(string $path, string $default): string
    {
        try {
            $value = $this->extensionConfiguration->get(self::EXTENSION_KEY, $path);
        } catch (ExtensionConfigurationExtensionNotConfiguredException | ExtensionConfigurationPathDoesNotExistException) {
            return $default;
        }

        if (is_string($value)) {
            return $value;
        }
        return $default;
    }
}
