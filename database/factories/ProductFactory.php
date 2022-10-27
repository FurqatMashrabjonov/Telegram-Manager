<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    protected $model = Product::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 101,
            'name' => fake()->name,
            'price' => fake()->randomFloat(2, 100000, 999999),
            'description' => fake()->text,
            'category_id' => rand(0, 10),
            'status' => rand(0, 1)
        ];
    }
}
