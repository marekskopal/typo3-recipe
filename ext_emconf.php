<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Recipe',
    'description' => 'Recipe extension for tx_news plugin',
    'category' => 'plugin',
    'author' => 'Marek Skopal',
    'author_email' => 'skopal.marek@gmail.com',
    'state' => 'stable',
    'internal' => '',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-14.3.99',
            'news' => '14.0.0-14.99.99'
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ]
    ]
];
