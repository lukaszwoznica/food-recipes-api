<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->foodName(),
            'subtitle' => $this->faker->text(50),
            'preparation_time' => rand(5, 360),
            'difficulty_level' => rand(1, 5),
            'servings' => rand(1, 10),
            'method' => $this->faker->text(),
            'author_id' => User::select('id')->inRandomOrder()->first(),
        ];
    }
}
