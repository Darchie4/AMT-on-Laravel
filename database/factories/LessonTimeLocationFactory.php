<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\Location;
use Carbon\Carbon;
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
            'week_day' => rand(0,6),
            'start_time' => Carbon::parse(fake()->time())->format('H:i'),
            'end_time' => Carbon::parse(fake()->time())->format('H:i'),

            'lesson_id' => Lesson::inRandomOrder()->first()->id,
            'location_id' => Location::inRandomOrder()->first()->id
        ];
    }
}
