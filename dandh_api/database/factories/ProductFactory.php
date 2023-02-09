<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "itemId" => fake()->swiftBicNumber(),
            "price" => fake()->numberBetween(10, 1000),
            "vendorId" => fake()->swiftBicNumber(),
            "vendorName" => fake()->company(),
            "description" => fake()->text(),
            "imageUrl" => fake()->imageUrl()
        ];
    }
}
