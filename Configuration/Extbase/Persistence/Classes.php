<?php
declare(strict_types = 1);

return [
    \GeorgRinger\News\Domain\Model\News::class => [
        'subclasses' => [
            3 => \MarekSkopal\MsRecipe\Domain\Model\Recipe::class,
        ]
    ],
    \MarekSkopal\MsRecipe\Domain\Model\Recipe::class => [
        'tableName' => 'tx_news_domain_model_news',
        'recordType' => 3,
    ],
];
