<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->faker->text,
            "description" =>  $this->faker->realText,
            "image_path" => $this->faker->imageUrl,
            "price" => $this->faker->numberBetween(50, 100)
        ];
    }
}
