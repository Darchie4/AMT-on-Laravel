<?php

namespace Database\Seeders;

use App\Models\InstructorInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstructorInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InstructorInfo::factory()->times(5);
    }
}
