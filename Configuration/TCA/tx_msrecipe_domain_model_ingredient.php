<?php

declare(strict_types=1);

defined('TYPO3') or die;

$llPath = 'LLL:EXT:ms_recipe/Resources/Private/Language/locallang_db.xlf';
$table = 'tx_msrecipe_domain_model_ingredient';

return [
    'ctrl' => [
        'title' => $llPath . ':' . $table,
        'label' => 'ingredient',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'dividers2tabs' => true,
        'sortby' => 'sorting',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'ingredient',
        'iconfile' => 'EXT:ms_recipe/Resources/Public/Icons/tx_msrecipe_domain_model_ingredient.svg',
    ],
    'interface' => [],
    'types' => [
        '1' => [
            'showitem' => 'ingredient',
        ],
    ],
    'palettes' => [
        '1' => [
            'showitem' => '',
        ],
    ],
    'columns' => [
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'ingredient' => [
            'exclude' => 1,
            'label' => $llPath . ':tx_mscatalog_domain_model_product.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 2,
                'eval' => 'trim',
            ],
        ],
    ],
];
