<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\PaymentStructure;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use function request;

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
        if (!$user) {
            return redirect(route('login'))->withErrors(__('registration.public_signup_errors_hasToBeLoggedIn'));
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
        return redirect(route('lesson.index'))->withErrors(__('registration.public_signup_errors_cannotSignUp'));
    }

    public function doUserSignup(int $lesson_id, int $user_id): Application|Redirector|RedirectResponse
    {
        $lesson = Lesson::findOrFail($lesson_id);
        $user = User::findOrFail($user_id);
        if (!$lesson->canSignupUser($user)) {
            return redirect(route('lesson.index'))->withErrors(__('registration.public_signup_errors_cannotSignUp', ['lessonName' => $lesson->name]));
        }

        $isSignedUp = $user->lessons()->where('lesson_id', '=', $lesson->id)->where('is_active', '=', true)->first();

        if ($isSignedUp) {
            return redirect(route('lesson.index'))->withErrors(__('registration.public_signup_errors_alreadySignedUp', ['lessonName' => $lesson->name]));
        }

        $registration = new Registration();
        $registration->user()->associate($user);
        $registration->lesson()->associate($lesson);
        $paymentStructure = new PaymentStructure();
        $paymentStructure->save();
        $registration->paymentStructure()->associate($paymentStructure);
        $registration->activation_date = Date::now();
        $registration->save();

        return redirect(route('signups.public.index'))->with('success', __('registration.public_signup_success', ['lessonName' => $lesson->name]));
    }

    /**
     * Show the view for signing up for a lesson
     *
     * @param int $id
     * @return Application|RedirectResponse|Redirector|Renderable
     */
    public function adminUserSignups(int $id): Application|RedirectResponse|Redirector|Renderable
    {
        $user = User::findOrFail($id);
        $registrations = $user->registrations()->get();
        return view('signUp/admin/userIndex', ['user' => $user, 'registrations' => $registrations]);
    }

    /**
     * Show the view for signing up for a lesson
     *
     * @param int $id
     * @return Application|RedirectResponse|Redirector|Renderable
     */
    public function adminLessonSignups(int $id): Application|RedirectResponse|Redirector|Renderable
    {
        $lesson = Lesson::findOrFail($id);
        $registrations = $lesson->registrations()->get();
        return view('signUp/admin/lessonIndex', ['lesson' => $lesson, 'registrations' => $registrations]);
    }

    public function endRegistration(int $id): Application|RedirectResponse|Redirector|Renderable
    {
        $registration = Registration::findOrFail($id);
        $registration->is_active = false;
        $registration->deactivation_date = Date::now();
        $registration->save();
        return back();
    }

    public function doMoveUser($request)
    {
        $request->validate([
            'fromLessonId' => 'required|exists:lessons,id',
            'toLessonId' => 'required|exists:lessons,id',
            'userID' => 'required|exists:users,id',
        ]);

        $user = User::find(request('fromLessonId'));
        $fromLesson = Lesson::find(request('toLessonId'));
        $toLesson = Lesson::find(request('userID'));

        $fromRegistration = $user->registrations()->where('lesson_id', $fromLesson->id)->get();

        if ($fromRegistration->isEmpty()) {
            return redirect(route('lesson.index'))->withErrors(__('registration.public_signup_errors_fromRegistrationNotFound'));
        }

        $fromRegistration->deactivation_date = Date::now();
        $fromRegistration->is_active = false;

        $fromRegistration->save();


        $newRegistration = new Registration();

        $newRegistration->user()->associate($user);
        $newRegistration->lesson()->associate($toLesson);
        $newRegistration->activation_date = Date::now();

        $newRegistration->save();

        return back()->with('success', __('registration.admin_moveSingle_success', ['fromLessonName' => $fromLesson->name, 'toLessonName' => $toLesson->name, 'userName' => $user->name]));
    }

    public function moveUser(Lesson $lesson, User $user){
        return view('signUp/admin/move/move', ['fromLesson' => $lesson, 'users' => [$user], 'lessons' => Lesson::all()]);
    }

    public function moveUsers($request){

    }

    public function doMoveUsers(Request $request)
    {
        $request->validate([
            'fromLessonId' => 'required|exists:lessons,id',
            'toLesson' => 'required|exists:lessons,id',
        ]);

        $fromLesson = Lesson::findOrFail($request->fromLessonId);
        $toLesson = Lesson::findOrFail($request->toLesson);

        foreach (explode(',', $request->users) as $userID) {
            $user = User::findOrFail($userID);

            $fromRegistration = $user->registrations()->where('lesson_id', $fromLesson->id)->first();

            if (!$fromRegistration) {
                return redirect(route('lesson.index'))->withErrors(__('registration.public_signup_errors_fromRegistrationNotFound'));
            }

            $fromRegistration->deactivation_date = now();
            $fromRegistration->is_active = false;

            $fromRegistration->save();

            $newRegistration = new Registration();
            $newRegistration->user()->associate($user);
            $newRegistration->lesson()->associate($toLesson);
            $newRegistration->pricingStructure()->associate($toLesson->pricing_structure_id);
            $newRegistration->activation_date = now();

            $newRegistration->save();
        }

        return redirect(route('admin.lesson.index'))->with('success', __('registration.admin_moveMultiple_success', ['count' => count(explode(',', $request->users)), 'fromLessonName' => $fromLesson->name, 'toLessonName' => $toLesson->name]));
    }

}
