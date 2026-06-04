<?php

declare(strict_types=1);

namespace MarekSkopal\MsRecipe\Tests\Unit\Service;

use DateTime;
use MarekSkopal\MsRecipe\Configuration\AuthorConfig;
use MarekSkopal\MsRecipe\Domain\Model\Ingredient;
use MarekSkopal\MsRecipe\Domain\Model\IngredientSection;
use MarekSkopal\MsRecipe\Domain\Model\Instruction;
use MarekSkopal\MsRecipe\Domain\Model\InstructionSection;
use MarekSkopal\MsRecipe\Domain\Model\Recipe;
use MarekSkopal\MsRecipe\Service\AuthorConfigProvider;
use MarekSkopal\MsRecipe\Service\RecipeStructuredDataBuilder;
use PHPUnit\Framework\TestCase;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

final class RecipeStructuredDataBuilderTest extends TestCase
{
    public function testMinimalRecipeProducesSchemaScaffold(): void
    {
        $recipe = new Recipe();
        $recipe->setTitle('Pancakes');

        $data = $this->createBuilder()->build($recipe);

        self::assertSame('https://schema.org/', $data['@context']);
        self::assertSame('Recipe', $data['@type']);
        self::assertSame('Pancakes', $data['name']);
        self::assertNull($data['datePublished']);
        self::assertArrayNotHasKey('description', $data);
        self::assertArrayNotHasKey('recipeYield', $data);
        self::assertArrayNotHasKey('nutrition', $data);
        self::assertArrayNotHasKey('recipeIngredient', $data);
        self::assertArrayNotHasKey('recipeInstructions', $data);
        self::assertArrayNotHasKey('author', $data);
        self::assertArrayNotHasKey('image', $data);
    }

    public function testIncludesAuthorWhenConfigured(): void
    {
        $recipe = new Recipe();
        $recipe->setTitle('Pancakes');

        $data = $this->createBuilder(new AuthorConfig('Marek Skopal', 'https://marekskopal.com'))->build($recipe);

        self::assertSame(
            ['@type' => 'Person', 'name' => 'Marek Skopal', 'url' => 'https://marekskopal.com'],
            $data['author'],
        );
    }

    public function testAuthorWithoutUrlOmitsUrl(): void
    {
        $recipe = new Recipe();
        $data = $this->createBuilder(new AuthorConfig('Marek Skopal'))->build($recipe);

        self::assertSame(['@type' => 'Person', 'name' => 'Marek Skopal'], $data['author']);
    }

    public function testDescriptionTeaserAndDate(): void
    {
        $recipe = new Recipe();
        $recipe->setTeaser('A short description');
        $recipe->setKeywords('breakfast,pancakes');
        $recipe->setDatetime(new DateTime('2026-01-15 12:30:00'));

        $data = $this->createBuilder()->build($recipe);

        self::assertSame('A short description', $data['description']);
        self::assertSame('breakfast,pancakes', $data['keywords']);
        self::assertSame('2026-01-15', $data['datePublished']);
    }

    public function testYieldAndCalories(): void
    {
        $recipe = new Recipe();
        $recipe->setNutritionYield('4 servings');
        $recipe->setNutritionCalories(450);

        $data = $this->createBuilder()->build($recipe);

        self::assertSame('4 servings', $data['recipeYield']);
        self::assertSame(
            ['@type' => 'NutritionInformation', 'calories' => 450],
            $data['nutrition'],
        );
    }

    public function testZeroCaloriesAreOmitted(): void
    {
        $recipe = new Recipe();
        $recipe->setNutritionCalories(0);

        $data = $this->createBuilder()->build($recipe);

        self::assertArrayNotHasKey('nutrition', $data);
    }

    public function testSingleIngredientSectionFlattensIngredients(): void
    {
        $section = new IngredientSection();
        $section->getIngredients()->attach($this->makeIngredient('200g flour'));
        $section->getIngredients()->attach($this->makeIngredient('2 eggs'));

        $recipe = new Recipe();
        $sections = new ObjectStorage();
        $sections->attach($section);
        $recipe->setIngredientSections($sections);

        $data = $this->createBuilder()->build($recipe);

        self::assertSame(['200g flour', '2 eggs'], $data['recipeIngredient']);
    }

    public function testSingleInstructionSectionEmitsHowToSteps(): void
    {
        $section = new InstructionSection();
        $section->setTitle('Method');
        $section->getInstructions()->attach($this->makeInstruction('Mix dry ingredients'));
        $section->getInstructions()->attach($this->makeInstruction('Add eggs'));

        $recipe = new Recipe();
        $sections = new ObjectStorage();
        $sections->attach($section);
        $recipe->setInstructionSections($sections);

        $data = $this->createBuilder()->build($recipe);

        self::assertSame(
            [
                ['@type' => 'HowToStep', 'text' => 'Mix dry ingredients'],
                ['@type' => 'HowToStep', 'text' => 'Add eggs'],
            ],
            $data['recipeInstructions'],
        );
    }

    public function testMultipleInstructionSectionsEmitHowToSections(): void
    {
        $prep = new InstructionSection();
        $prep->setTitle('Prep');
        $prep->getInstructions()->attach($this->makeInstruction('Chop onions'));

        $cook = new InstructionSection();
        $cook->setTitle('Cook');
        $cook->getInstructions()->attach($this->makeInstruction('Fry onions'));
        $cook->getInstructions()->attach($this->makeInstruction('Add tomatoes'));

        $recipe = new Recipe();
        $sections = new ObjectStorage();
        $sections->attach($prep);
        $sections->attach($cook);
        $recipe->setInstructionSections($sections);

        $data = $this->createBuilder()->build($recipe);

        self::assertSame(
            [
                [
                    '@type' => 'HowToSection',
                    'name' => 'Prep',
                    'itemListElement' => [
                        ['@type' => 'HowToStep', 'text' => 'Chop onions'],
                    ],
                ],
                [
                    '@type' => 'HowToSection',
                    'name' => 'Cook',
                    'itemListElement' => [
                        ['@type' => 'HowToStep', 'text' => 'Fry onions'],
                        ['@type' => 'HowToStep', 'text' => 'Add tomatoes'],
                    ],
                ],
            ],
            $data['recipeInstructions'],
        );
    }

    private function createBuilder(?AuthorConfig $authorConfig = null): RecipeStructuredDataBuilder
    {
        $provider = $this->createStub(AuthorConfigProvider::class);
        $provider->method('get')->willReturn($authorConfig ?? new AuthorConfig());

        return new RecipeStructuredDataBuilder($provider);
    }

    private function makeIngredient(string $text): Ingredient
    {
        $ingredient = new Ingredient();
        $ingredient->setIngredient($text);

        return $ingredient;
    }

    private function makeInstruction(string $text): Instruction
    {
        $instruction = new Instruction();
        $instruction->setInstruction($text);

        return $instruction;
    }
}
