<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'street_number' => rand(1, 999),
            'street_name' => fake()->streetName(),
            'zip_code' => rand(1000, 9999),
            'city' => fake()->city(),
            'country' => fake()->country(),
        ];
    }
}
