<?php

namespace App\GraphQL\Mutations\Quest;

use App\Models\Quest;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class DeleteQuestMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteQuest',
    ];

    public function type(): Type
    {
        return GraphQL::type('Quest');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required', 'exists:quests,id'],
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $quest = Quest::findOrFail($args['id']);
        $quest->delete();
        return $quest;
    }
}
