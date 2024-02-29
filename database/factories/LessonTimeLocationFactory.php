<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LessonTimeLocation>
 */
class LessonTimeLocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'week_day' => rand(1,7),
            'start_time' => fake()->time(),
            'end_time' => fake()->time(),

            'lesson_id' => Lesson::inRandomOrder()->first()->id,
            'location_id' => Location::inRandomOrder()->first()->id
        ];
    }
}
