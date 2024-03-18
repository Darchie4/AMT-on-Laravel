<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\PaymentStructure;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Date;

class RegistrationController extends Controller
{

    /**
     * Show the view for signing up for a lesson
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function userSignUp(int $id): Application|RedirectResponse|Redirector|Renderable
    {
        $lesson = Lesson::findOrFail($id);
        if ($lesson->canSignup()) {
            return view('signUp/public/signup', ['lesson' => $lesson]);
        }
        return redirect(route('lesson.index'))->withErrors(__('public_signup_errors_cannotSignUp'));
    }

    public function doUserSignup(int $lesson_id, int $user_id)
    {
        $lesson = Lesson::findOrFail($lesson_id);
        $user = User::findOrFail($user_id);
        if (!$lesson->canSignupUser($user)) {
            return redirect(route('lesson.index'))->withErrors(__('public_signup_errors_cannotSignUp'));
        }

        $registration = new Registration();
        $registration->user()->associate($user);
        $registration->lesson()->associate($lesson);
        $paymentStructure = new PaymentStructure();
        $paymentStructure->save();
        $registration->paymentStructure()->associate($paymentStructure);
        $registration->activation_date = Date::now();
        $registration->save();

        dd($registration);
    }

}
