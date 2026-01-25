<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die;

$llPath = 'LLL:EXT:ms_recipe/Resources/Private/Language/locallang_db.xlf';
$table = 'tx_news_domain_model_news';

$fields = [
    'ingredient_sections' => [
        'exclude' => 1,
        'label' => $llPath . ':' . $table . '.ingredient_sections',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_msrecipe_domain_model_ingredientsection',
            'foreign_field' => 'news',
        ],
    ],
    'ingredient_text' => [
        'exclude' => 1,
        'label' => $llPath . ':' . $table . '.ingredient_text',
        'config' => [
            'type' => 'text',
            'cols' => 40,
            'rows' => 15,
            'eval' => 'trim',
            'enableRichtext' => true,
        ],
    ],
    'instruction_sections' => [
        'exclude' => 1,
        'label' => $llPath . ':' . $table . '.instruction_sections',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_msrecipe_domain_model_instructionsection',
            'foreign_field' => 'news',
        ],
    ],
    'instruction_text' => [
        'exclude' => 1,
        'label' => $llPath . ':' . $table . '.instruction_text',
        'config' => [
            'type' => 'text',
            'cols' => 40,
            'rows' => 15,
            'eval' => 'trim',
            'enableRichtext' => true,
        ],
    ],
    'nutrition_yield' => [
        'exclude' => 1,
        'label' => $llPath . ':' . $table . '.nutrition_yield',
        'config' => [
            'type' => 'text',
            'cols' => 40,
            'rows' => 2,
            'eval' => 'trim',
        ],
    ],
    'nutrition_calories' => [
        'exclude' => 1,
        'label' => $llPath . ':' . $table . '.nutrition_calories',
        'config' => [
            'type' => 'number',
            'size' => 10,
            'format' => 'integer',
            'range' => [
                'lower' => 0,
                'upper' => 99999,
            ],
            'default' => 0,
        ],
    ],
    'nutrition_proteins' => [
        'exclude' => 1,
        'label' => $llPath . ':' . $table . '.nutrition_proteins',
        'config' => [
            'type' => 'number',
            'size' => 10,
            'format' => 'integer',
            'range' => [
                'lower' => 0,
                'upper' => 99999,
            ],
            'default' => 0,
        ],
    ],
    'nutrition_carbs' => [
        'exclude' => 1,
        'label' => $llPath . ':' . $table . '.nutrition_carbs',
        'config' => [
            'type' => 'number',
            'size' => 10,
            'format' => 'integer',
            'range' => [
                'lower' => 0,
                'upper' => 99999,
            ],
            'default' => 0,
        ],
    ],
    'nutrition_fats' => [
        'exclude' => 1,
        'label' => $llPath . ':' . $table . '.nutrition_fats',
        'config' => [
            'type' => 'number',
            'size' => 10,
            'format' => 'integer',
            'range' => [
                'lower' => 0,
                'upper' => 99999,
            ],
            'default' => 0,
        ],
    ],
    'nutrition_fiber' => [
        'exclude' => 1,
        'label' => $llPath . ':' . $table . '.nutrition_fiber',
        'config' => [
            'type' => 'number',
            'size' => 10,
            'format' => 'integer',
            'range' => [
                'lower' => 0,
                'upper' => 99999,
            ],
            'default' => 0,
        ],
    ],
];

/** @phpstan-ignore-next-line offsetAccess.nonOffsetAccessible */
$GLOBALS['TCA'][$table]['palettes']['palette_recipe'] = [
    'canNotCollapse' => true,
    'showitem' => 'ingredient_sections,ingredient_text,--linebreak--,
        instruction_sections,instruction_text,--linebreak--,
        nutrition_yield,--linebreak--,
        nutrition_calories,nutrition_proteins,nutrition_carbs,nutrition_fats,nutrition_fiber',
];

/** @phpstan-ignore-next-line offsetAccess.nonOffsetAccessible */
$GLOBALS['TCA'][$table]['columns']['type']['config']['items']['3'] = [
    'label' => $llPath . ':recipe_type',
    'value' => 3,
];

/** @phpstan-ignore-next-line offsetAccess.nonOffsetAccessible */
$GLOBALS['TCA'][$table]['types']['3'] = $GLOBALS['TCA'][$table]['types']['0'];

ExtensionManagementUtility::addTCAcolumns($table, $fields);
ExtensionManagementUtility::addToAllTCAtypes($table, '--palette--;;palette_recipe', '3', 'after:bodytext');
