# Laravel GraphQL CRUD Example

This repository demonstrates how to create a Laravel application with GraphQL support using the Rebing GraphQL package. The application includes full CRUD operations for `Category` and `Quest` models.

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Database Setup](#database-setup)
- [GraphQL Setup](#graphql-setup)
- [GraphQL Types](#graphql-types)
- [GraphQL Queries](#graphql-queries)
- [GraphQL Mutations](#graphql-mutations)
- [Testing GraphQL](#testing-graphql)
- [License](#license)

## Requirements

- PHP >= 8.0
- Composer
- Laravel >= 8.0
- MySQL or any other supported database

## Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/your-username/laravel-graphql-crud.git
    cd laravel-graphql-crud
    ```

2. **Install dependencies:**

    ```bash
    composer install
    ```

3. **Copy `.env.example` to `.env` and configure your database settings:**

    ```bash
    cp .env.example .env
    ```

4. **Generate an application key:**

    ```bash
    php artisan key:generate
    ```

## Database Setup

1. **Run migrations:**

    ```bash
    php artisan migrate
    ```

2. **Seed the database with fake data:**

    ```bash
    php artisan db:seed
    ```

## GraphQL Setup

1. **Install Rebing GraphQL package:**

    ```bash
    composer require rebing/graphql-laravel
    ```

2. **Publish the GraphQL configuration:**

    ```bash
    php artisan vendor:publish --provider="Rebing\GraphQL\GraphQLServiceProvider"
    ```

3. **Configure GraphQL in `config/graphql.php`:**

    ```php
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
    ```

## GraphQL Types

Define the GraphQL types for `Category` and `Quest`.

### `CategoryType`

```php
<?php

namespace App\GraphQL\Types;

use App\Models\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CategoryType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Category',
        'description' => 'A collection of categories',
        'model' => Category::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Id of the category',
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Title of the category',
            ],
            'quests' => [
                'type' => Type::listOf(GraphQL::type('Quest')),
                'description' => 'List of quests associated with the category',
            ],
        ];
    }
}
