<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TheMealDbApiService
{
    private string $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('the-meal-db-api.base_url') . '/' . config('the-meal-db-api.key') . '/';
    }

    public function getRandomRecipe(): mixed
    {
        return Http::get($this->apiUrl . 'random.php')->json();
    }

    public function getAllIngredients(): mixed
    {
        return Http::get($this->apiUrl . 'list.php', ['i' => 'list'])->json();
    }

    public function getAllCategories(): mixed
    {
        return Http::get($this->apiUrl . 'list.php', ['c' => 'list'])->json();
    }

    public function findRecipesByFirstLetter(string $letter)
    {
        return Http::get($this->apiUrl . 'search.php', [
            'f' => substr($letter, 0, 1)
        ])->json();
    }
}
