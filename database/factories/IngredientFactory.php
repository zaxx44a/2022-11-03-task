<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'current' => fake()->randomElements([100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, 2000, 3000 ]),
            'threshold' => fake()->randomElements([20, 30, 40, 50, 60, 70 ]),
            'full_load' => fake()->randomElements([3000, 4000, 5000, 10000, 20000 ]),
            'unit' => fake()->randomElements(['kilo', 'unit', 'gram' ]),
        ];
    }
}
