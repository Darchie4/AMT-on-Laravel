<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->streetName(),
            'short_description' => fake()->sentence(6),
            'long_description' => fake()->randomHtml(),
            'cover_img_path' => fake()->filePath(),
            'address_id' => Address::inRandomOrder()->first()->id,

        ];
    }
}
