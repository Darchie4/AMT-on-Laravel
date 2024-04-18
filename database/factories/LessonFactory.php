<?php

namespace Database\Factories;

use App\Models\DanceStyle;
use App\Models\Difficulty;
use App\Models\PricingStructure;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\DateFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'short_description' => fake()->sentence(6),
            'long_description' => fake()->randomHtml(),
            'season_start' => fake()->dateTimeBetween('-1 years')->format('Y-m-d '),
            'season_end' => fake()->dateTimeBetween('now', '+1 years')->format('Y-m-d '),
            'age_min' => rand(1,20),
            'age_max' => rand(20,99),
            'price' => rand(200,800),
            'cover_img_path' => fake()->filePath(),
            'dance_style_id' => DanceStyle::inRandomOrder()->first()->id,
            'difficulty_id' => Difficulty::inRandomOrder()->first()->id,
            'pricing_structure_id' => PricingStructure::inRandomOrder()->first()->id,
            'total_signup_space' => rand(1,20),
            'can_signup' => rand(0,1),
            'visible' => rand(0,1),
        ];
    }
}
