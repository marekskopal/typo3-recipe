<?php

defined('TYPO3_MODE') or die();

$llPath = 'LLL:EXT:ms_recipe/Resources/Private/Language/locallang_db.xlf';

$fields = [
    'ingredient_sections' => [
        'exclude' => 1,
        'label' => $llPath . ':tx_news_domain_model_news.ingredient_sections',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_msrecipe_domain_model_ingredientsection',
            'foreign_field' => 'news',
        ]
    ],
    'ingredient_text' => [
        'exclude' => 1,
        'label' => $llPath . ':tx_news_domain_model_news.ingredient_text',
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
        'label' => $llPath . ':tx_news_domain_model_news.instruction_sections',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_msrecipe_domain_model_instructionsection',
            'foreign_field' => 'news',
        ]
    ],
    'instruction_text' => [
        'exclude' => 1,
        'label' => $llPath . ':tx_news_domain_model_news.instruction_text',
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
        'label' => $llPath . ':tx_news_domain_model_news.nutrition_yield',
        'config' => [
            'type' => 'text',
            'cols' => 40,
            'rows' => 2,
            'eval' => 'trim',
        ]
    ],
    'nutrition_calories' => [
        'exclude' => 1,
        'label' => $llPath . ':tx_news_domain_model_news.nutrition_calories',
        'config' => [
            'type' => 'input',
            'size' => 10,
            'eval' => 'trim,int',
            'range' => [
                'lower' => 0,
                'upper' => 99999,
            ],
            'default' => 0,
        ]
    ],
    'nutrition_proteins' => [
        'exclude' => 1,
        'label' => $llPath . ':tx_news_domain_model_news.nutrition_proteins',
        'config' => [
            'type' => 'input',
            'size' => 10,
            'eval' => 'trim,int',
            'range' => [
                'lower' => 0,
                'upper' => 99999,
            ],
            'default' => 0,
        ]
    ],
    'nutrition_carbs' => [
        'exclude' => 1,
        'label' => $llPath . ':tx_news_domain_model_news.nutrition_carbs',
        'config' => [
            'type' => 'input',
            'size' => 10,
            'eval' => 'trim,int',
            'range' => [
                'lower' => 0,
                'upper' => 99999,
            ],
            'default' => 0,
        ]
    ],
    'nutrition_fats' => [
        'exclude' => 1,
        'label' => $llPath . ':tx_news_domain_model_news.nutrition_fats',
        'config' => [
            'type' => 'input',
            'size' => 10,
            'eval' => 'trim,int',
            'range' => [
                'lower' => 0,
                'upper' => 99999,
            ],
            'default' => 0,
        ]
    ],
    'nutrition_fiber' => [
        'exclude' => 1,
        'label' => $llPath . ':tx_news_domain_model_news.nutrition_fiber',
        'config' => [
            'type' => 'input',
            'size' => 10,
            'eval' => 'trim,int',
            'range' => [
                'lower' => 0,
                'upper' => 99999,
            ],
            'default' => 0,
        ]
    ],
];

$GLOBALS['TCA']['tx_news_domain_model_news']['palettes']['palette_recipe'] = [
    'canNotCollapse' => true,
    'showitem' => 'ingredient_sections,ingredient_text,--linebreak--,
        instruction_sections,instruction_text,--linebreak--,
        nutrition_yield,--linebreak--,
        nutrition_calories,nutrition_proteins,nutrition_carbs,nutrition_fats,nutrition_fiber'
];

$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['type']['config']['items']['3'] = [
    $llPath . ':recipe_type',
    3
];

$GLOBALS['TCA']['tx_news_domain_model_news']['types']['3'] = $GLOBALS['TCA']['tx_news_domain_model_news']['types']['0'];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_news_domain_model_news', $fields);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tx_news_domain_model_news', '--palette--;;palette_recipe', '3', 'after:bodytext');
