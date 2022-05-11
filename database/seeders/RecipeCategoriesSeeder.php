<?php

namespace Database\Seeders;

use App\Models\RecipeCategory;
use App\Services\TheMealDbApiService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeCategoriesSeeder extends Seeder
{
    public function run(TheMealDbApiService $mealDbApiService): void
    {
        collect($mealDbApiService->getAllCategories())
            ->flatten(1)
            ->pluck('strCategory')
            ->each(function ($category) {
                RecipeCategory::factory()->create([
                    'name' => ucfirst($category)
                ]);
            });
    }
}
