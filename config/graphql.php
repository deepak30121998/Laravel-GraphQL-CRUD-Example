<?php

declare(strict_types = 1);

return [
    'schemas' => [
        'default' => [
            'query' => [
                'category' => \App\GraphQL\Queries\Category\CategoryQuery::class,
                'categories' => \App\GraphQL\Queries\Category\CategoriesQuery::class,
                'quest' => \App\GraphQL\Queries\Quest\QuestQuery::class,
                'quests' => \App\GraphQL\Queries\Quest\QuestsQuery::class,
            ],
            'mutation' => [
                'createCategory' => \App\GraphQL\Mutations\Category\CreateCategoryMutation::class,
                'updateCategory' => \App\GraphQL\Mutations\Category\UpdateCategoryMutation::class,
                'deleteCategory' => \App\GraphQL\Mutations\Category\DeleteCategoryMutation::class,
                'createQuest' => \App\GraphQL\Mutations\Quest\CreateQuestMutation::class,
                'updateQuest' => \App\GraphQL\Mutations\Quest\UpdateQuestMutation::class,
                'deleteQuest' => \App\GraphQL\Mutations\Quest\DeleteQuestMutation::class,
            ],
            'types' => [
                'Category' => \App\GraphQL\Types\CategoryType::class,
                'Quest' => \App\GraphQL\Types\QuestType::class,
            ],
            'middleware' => null,
            'method' => ['GET', 'POST'],
            'execution_middleware' => null,
        ],
    ],
    'types' => [],
    'error_formatter' => [\Rebing\GraphQL\GraphQL::class, 'formatError'],
    'errors_handler' => [\Rebing\GraphQL\GraphQL::class, 'handleErrors'],
];
