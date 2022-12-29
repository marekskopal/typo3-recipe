<?php

if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

$llPath = 'LLL:EXT:ms_recipe/Resources/Private/Language/locallang_db.xlf';

$GLOBALS['TCA']['tx_msrecipe_domain_model_instruction'] = [
    'ctrl' => [
        'title' => $llPath . ':tx_msrecipe_domain_model_instruction',
        'label' => 'instruction',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,
        'sortby' => 'sorting',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden'
        ],
        'searchFields' => 'instruction',
        'iconfile' => 'EXT:ms_recipe/Resources/Public/Icons/tx_msrecipe_domain_model_instruction.svg'
    ],
    'interface' => [
    ],
    'types' => [
        '1' => [
            'showitem' => 'instruction'
        ]
    ],
    'palettes' => [
        '1' => [
            'showitem' => ''
        ]
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
                        -1
                    ],
                    [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.default_value',
                        0
                    ]
                ]
            ]
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        '',
                        0
                    ]
                ],
                'foreign_table' => 'tx_msrecipe_domain_model_instruction',
                'foreign_table_where' => 'AND tx_msrecipe_domain_model_instruction.pid=###CURRENT_PID### AND tx_msrecipe_domain_model_instruction.sys_language_uid IN (-1,0)'
            ]
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough'
            ]
        ],
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check'
            ]
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
