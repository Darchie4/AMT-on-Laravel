<?php

namespace Database\Seeders;

use App\Models\LessonTimeLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonTimeLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LessonTimeLocation::factory()->times(75);
    }
}
