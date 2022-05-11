<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UsersSeeder::class);
        $this->call(IngredientsSeeder::class);
        $this->call(RecipeCategoriesSeeder::class);
        $this->call(RecipesSeeder::class);
    }
}
