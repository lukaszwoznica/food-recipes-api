<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\RecipeCategory;
use App\Services\TheMealDbApiService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipesSeeder extends Seeder
{
    public function run(TheMealDbApiService $mealDbApiService): void
    {
        foreach (range('a', 'z') as $letter) {
            collect($mealDbApiService->findRecipesByFirstLetter($letter))
                ->flatten(1)
                ->each(function ($recipe) {
                    if (!$recipe) {
                        return;
                    }

                    $recipeModel = Recipe::factory()->create([
                        'title' => $recipe['strMeal'],
                        'method' => $recipe['strInstructions']
                    ]);

                    $recipeModel->ingredients()->sync($this->prepareIngredientRecipePivotTableData($recipe));
                    $recipeModel->categories()->attach($this->getRecipeCategoryId($recipe['strCategory']));
                });
        }
    }

    private function prepareIngredientRecipePivotTableData(array $recipeData): array
    {
        $ingredientIds = [];

        collect($recipeData)
            ->filter(fn($value, $key) => preg_match('/strIngredient\d+/', $key) && !empty(trim($value)))
            ->values()
            ->map(fn($value) => ['name' => ucfirst($value)])
            ->each(function ($ingredient) use (&$ingredientIds) {
                $ingredientIds[] = [
                    'id' => Ingredient::firstOrCreate(['name' => $ingredient['name']])->id
                ];
            });

        $ingredientMeasures = collect($recipeData)
            ->filter(fn($value, $key) => preg_match('/strMeasure\d+/', $key) && !empty(trim($value)))
            ->values()
            ->map(fn($value) => ['measure' => ucfirst($value)])
            ->toArray();

        return collect(array_merge_recursive_distinct($ingredientIds, $ingredientMeasures))
            ->mapWithKeys(fn($item) => [$item['id'] => ['measure' => $item['measure'] ?? '-']])
            ->toArray();
    }

    private function getRecipeCategoryId(string $categoryName): int
    {
        return RecipeCategory::firstOrCreate(['name' => ucfirst($categoryName)])->id;
    }
}
