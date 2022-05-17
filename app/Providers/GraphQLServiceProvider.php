<?php

namespace App\Providers;

use App\Enums\RecipeDifficultyLevel;
use GraphQL\Type\Definition\EnumType;
use Illuminate\Support\ServiceProvider;
use Nuwave\Lighthouse\Schema\TypeRegistry;

class GraphQLServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $recipeDifficultyLeveLEnum = new EnumType([
            'name' => 'RecipeDifficultyLevelEnum',
            'description' => 'Difficulty levels of preparing the dish.',
            'values' => RecipeDifficultyLevel::getGraphQLTypeArray()
        ]);

        app(TypeRegistry::class)->register($recipeDifficultyLeveLEnum);
    }
}
