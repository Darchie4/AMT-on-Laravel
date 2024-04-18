<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\PaymentStructure;
use App\Models\PricingStructure;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lesson::all()->each(function (Lesson $lesson) {
            $rand = rand(0, $lesson->total_signup_space);
            for ($i = 0; $i < $rand; $i++) {
                $user = User::inRandomOrder()->first();
                if ($lesson->canSignupUser($user)) {
                    $this->createRegistration($user, $lesson);
                }
            }
        });
    }

    /**
     * @param $user
     * @param Lesson $lesson
     * @return void
     */
    function createRegistration($user, Lesson $lesson): void
    {
        $registration = new Registration();
        $registration->user()->associate($user);
        $registration->lesson()->associate($lesson);
        $paymentStructure = PricingStructure::inRandomOrder()->first()->id;
        $registration->pricingStructure()->associate($paymentStructure);
        $registration->activation_date = Date::now();
        $registration->save();
    }
}
