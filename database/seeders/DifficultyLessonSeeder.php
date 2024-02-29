<?php

namespace Database\Seeders;

use App\Models\DanceStyle;
use App\Models\Difficulty;
use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DifficultyLessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lesson::all()->each(function (Lesson $lesson){
            $lesson->danceStyle()->associate(Difficulty::inRandomOrder()->first()->id);
        });
    }
}
