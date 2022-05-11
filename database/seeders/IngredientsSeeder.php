<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Services\TheMealDbApiService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientsSeeder extends Seeder
{
    public function run(TheMealDbApiService $mealDbApiService): void
    {
        collect($mealDbApiService->getAllIngredients())
            ->flatten(1)
            ->pluck('strIngredient')
            ->each(function (string $ingredient) {
                Ingredient::factory()->create([
                    'name' => ucfirst($ingredient)
                ]);
            });
    }
}
