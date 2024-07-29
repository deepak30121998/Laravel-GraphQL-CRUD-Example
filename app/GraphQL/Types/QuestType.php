<?php

namespace App\GraphQL\Types;

use App\Models\Quest;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;

class QuestType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Quest',
        'description' => 'A collection of quests with their respective category',
        'model' => Quest::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Id of the quest',
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Title of the quest',
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Description of the quest',
            ],
            'reward' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Quest reward',
            ],
            'category' => [
                'type' => GraphQL::type('Category'),
                'description' => 'The category of the quest',
            ],
        ];
    }
}