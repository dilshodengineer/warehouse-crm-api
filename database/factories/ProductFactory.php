<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [

            'name' => fake()->words(2, true),
            'price' => fake()->randomFloat(2, 100, 100000),
            'stock' => fake()->randomFloat(2, 1, 100),
            'unit' => fake()->randomElement(['kg', 'l', 'pcs']),
            'description' => fake()->sentence(),
        ];
    }
}