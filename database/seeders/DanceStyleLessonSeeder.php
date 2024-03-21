<?php

namespace Database\Seeders;

use App\Models\DanceStyle;
use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DanceStyleLessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lesson::all()->each(function (Lesson $lesson){
            $lesson->danceStyle()->associate(DanceStyle::inRandomOrder()->first());
        });
    }
}
