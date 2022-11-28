<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'thumbnail' => $this->faker->word(),
            'on_home_page' => $this->faker->boolean(),
            'sorting' => $this->faker->numberBetween(0, 999),
        ];
    }
}
