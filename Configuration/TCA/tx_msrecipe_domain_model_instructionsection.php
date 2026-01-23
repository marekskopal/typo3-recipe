<?php

declare(strict_types=1);

defined('TYPO3') or die;

$llPath = 'LLL:EXT:ms_recipe/Resources/Private/Language/locallang_db.xlf';
$table = 'tx_msrecipe_domain_model_instructionsection';

return [
    'ctrl' => [
        'title' => $llPath . ':' . $table,
        'label' => 'title',
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
        'searchFields' => 'title',
        'iconfile' => 'EXT:ms_recipe/Resources/Public/Icons/tx_msrecipe_domain_model_instructionsection.svg',
    ],
    'interface' => [],
    'types' => [
        '1' => [
            'showitem' => 'title, instructions',
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
        'title' => [
            'exclude' => 1,
            'label' => $llPath . ':tx_msrecipe_domain_model_instructionsection.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'instructions' => [
            'exclude' => 1,
            'label' => $llPath . ':tx_msrecipe_domain_model_instructionsection.instructions',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_msrecipe_domain_model_instruction',
                'foreign_field' => 'instruction_section',
            ],
        ],
    ],
];
