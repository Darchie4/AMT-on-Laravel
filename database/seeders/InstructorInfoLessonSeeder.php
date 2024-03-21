<?php

namespace Database\Seeders;

use App\Models\DanceStyle;
use App\Models\InstructorInfo;
use App\Models\InstructorInfoLesson;
use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstructorInfoLessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lesson::all()->each(function (Lesson $lesson) {
            $rand = rand(1,3);
            for ($i = 0; $i < $rand; $i++) {
                $lesson->instructors()->attach(InstructorInfo::inRandomOrder()->first());
            }
        });
    }
}
