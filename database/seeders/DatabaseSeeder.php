<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\LessonTimeLocation;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AddressSeeder::class,
            UserSeeder::class,
            DanceStyleSeeder::class,
            DifficultySeeder::class,
            RolesAndPermissionsSeeder::class,
            LocationSeeder::class,
            InstructorInfoSeeder::class,
            LessonSeeder::class,
            LessonTimeLocationSeeder::class,
            DanceStyleLessonSeeder::class,
            DifficultyLessonSeeder::class,
            InstructorInfoLessonSeeder::class,
            //RolePermissionSeeder::class,
            //RoleUserSeeder::class,
            RolesAndPermissionsSeeder::class
        ]);


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
