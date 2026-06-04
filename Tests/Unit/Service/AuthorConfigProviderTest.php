<?php

declare(strict_types=1);

namespace MarekSkopal\MsRecipe\Tests\Unit\Service;

use MarekSkopal\MsRecipe\Service\AuthorConfigProvider;
use PHPUnit\Framework\TestCase;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationPathDoesNotExistException;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;

final class AuthorConfigProviderTest extends TestCase
{
    public function testReturnsDefaultsWhenExtensionIsUnconfigured(): void
    {
        $extensionConfiguration = $this->createStub(ExtensionConfiguration::class);
        $extensionConfiguration
            ->method('get')
            ->willThrowException(new ExtensionConfigurationExtensionNotConfiguredException());

        $config = (new AuthorConfigProvider($extensionConfiguration))->get();

        self::assertSame('', $config->name);
        self::assertSame('', $config->url);
    }

    public function testFallsBackToDefaultForMissingPaths(): void
    {
        $extensionConfiguration = $this->createStub(ExtensionConfiguration::class);
        $extensionConfiguration
            ->method('get')
            ->willReturnCallback(static function (string $extension, string $path): string {
                if ($path === 'authorName') {
                    return 'Marek Skopal';
                }
                throw new ExtensionConfigurationPathDoesNotExistException();
            });

        $config = (new AuthorConfigProvider($extensionConfiguration))->get();

        self::assertSame('Marek Skopal', $config->name);
        self::assertSame('', $config->url);
    }

    public function testReadsAllValuesWhenProvided(): void
    {
        $values = [
            'authorName' => 'Marek Skopal',
            'authorUrl' => 'https://marekskopal.com',
        ];

        $extensionConfiguration = $this->createStub(ExtensionConfiguration::class);
        $extensionConfiguration
            ->method('get')
            ->willReturnCallback(static function (string $extension, string $path) use ($values): string {
                return $values[$path];
            });

        $config = (new AuthorConfigProvider($extensionConfiguration))->get();

        self::assertSame('Marek Skopal', $config->name);
        self::assertSame('https://marekskopal.com', $config->url);
    }

    public function testNonStringValueFallsBackToDefault(): void
    {
        $extensionConfiguration = $this->createStub(ExtensionConfiguration::class);
        $extensionConfiguration
            ->method('get')
            ->willReturn(42);

        $config = (new AuthorConfigProvider($extensionConfiguration))->get();

        self::assertSame('', $config->name);
        self::assertSame('', $config->url);
    }
}
