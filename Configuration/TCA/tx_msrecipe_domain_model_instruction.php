<?php

declare(strict_types=1);

defined('TYPO3') or die;

$llPath = 'LLL:EXT:ms_recipe/Resources/Private/Language/locallang_db.xlf';
$table = 'tx_msrecipe_domain_model_instruction';

return [
    'ctrl' => [
        'title' => $llPath . ':' . $table,
        'label' => 'instruction',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'sortby' => 'sorting',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'instruction',
        'iconfile' => 'EXT:ms_recipe/Resources/Public/Icons/tx_msrecipe_domain_model_instruction.svg',
    ],
    'types' => [
        '1' => [
            'showitem' => 'instruction',
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
        'instruction' => [
            'exclude' => 1,
            'label' => $llPath . ':tx_mscatalog_domain_model_product.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 4,
                'eval' => 'trim',
            ],
        ],
    ],
];
