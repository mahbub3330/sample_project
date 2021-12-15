<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{


    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'default_name' => $this->faker->word(),
            'custom_name' => $this->faker->name(),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(Product::STATUS),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
