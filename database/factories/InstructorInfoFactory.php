<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InstructorInfo>
 */
class InstructorInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'short_description' => fake()->sentence(6),
            'long_description' => fake()->randomHtml(),
            'cover_img_path' => fake()->filePath(),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
