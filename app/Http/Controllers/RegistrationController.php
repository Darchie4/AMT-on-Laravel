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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class RegistrationController extends Controller
{

    /**
     * Show the view for signing up for a lesson
     *
     * @param int $id
     * @return Application|RedirectResponse|Redirector|Renderable
     */
    public function userIndex(): Application|RedirectResponse|Redirector|Renderable
    {
        $user = Auth::user();
        if (!$user){
            return redirect(route('lesson.index'))->withErrors(__('public_signup_errors_hasToBeLoggedIn'));
        }
        $registrations = $user->registrations()->get();
        return view('signUp/public/index', ['registrations' => $registrations]);
    }

    /**
     * Show the view for signing up for a lesson
     *
     * @param int $id
     * @return Application|RedirectResponse|Redirector|Renderable
     */
    public function userSignUp(int $id): Application|RedirectResponse|Redirector|Renderable
    {
        $lesson = Lesson::findOrFail($id);
        if ($lesson->canSignup()) {
            return view('signUp/public/signup', ['lesson' => $lesson]);
        }
        return redirect(route('lesson.index'))->withErrors(__('public_signup_errors_cannotSignUp'));
    }

    public function doUserSignup(int $lesson_id, int $user_id): Application|Redirector|RedirectResponse
    {
        $lesson = Lesson::findOrFail($lesson_id);
        $user = User::findOrFail($user_id);
        if (!$lesson->canSignupUser($user)) {
            return redirect(route('lesson.index'))->withErrors(__('public_signup_errors_cannotSignUp'));
        }

        $isSignedUp = $user->lessons()->where('lesson_id', '=', $lesson->id)->first();

        if ($isSignedUp){
            return redirect(route('lesson.index'))->withErrors(__('public_signup_errors_alreadySignedUp'));
        }

        $registration = new Registration();
        $registration->user()->associate($user);
        $registration->lesson()->associate($lesson);
        $paymentStructure = new PaymentStructure();
        $paymentStructure->save();
        $registration->paymentStructure()->associate($paymentStructure);
        $registration->activation_date = Date::now();
        $registration->save();

        return redirect(route('lesson.index'));
    }

}