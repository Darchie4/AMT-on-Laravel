<?php

namespace Database\Seeders;

use App\Models\DanceStyle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DanceStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DanceStyle::factory()->times(10)->create();
    }
}
