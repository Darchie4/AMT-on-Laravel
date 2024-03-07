<?php

namespace App\Http\Controllers;

use App\Models\DanceStyle;
use App\Models\Difficulty;
use App\Models\InstructorInfo;
use App\Models\Lesson;
use App\Models\LessonTimeLocation;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class LessonController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function adminIndex(): Renderable
    {
        return view('lesson/admin/index', ['lessons' => Lesson::all()]);
    }

    public function adminShow(int $id): Renderable
    {
        return view('lesson/admin/show', ['lesson' => Lesson::findOrFail($id)]);
    }

    /**
     * Show the view for creating a new Lesson
     *
     * @return Renderable
     */
    public function adminCreate(): Renderable
    {
        return view('lesson/admin/create', ['instructors' => InstructorInfo::all(), 'locations' => Location::all(), 'danceStyles' => DanceStyle::all(), 'difficulties' => Difficulty::all()]);
    }

    /**
     * Show the view for creating a new Lesson
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function adminDoCreate(Request $request): Application|RedirectResponse|Redirector
    {
        $request->validate([
            'name' => 'required|string',
            'short_description' => 'required|string|max:255',
            'long_description' => 'required|string',
            'age_min' => 'required|integer',
            'age_max' => 'required|integer|gte:age_min',
            'season_start' => 'required|date',
            'season_end' => 'required|date|after_or_equal:season_start',
            'price' => 'required|numeric',
            'cover_image' => 'nullable|image|mimes:jpeg,png|max:2048',
            'danceStyle' => 'required|string',
            'difficulty' => 'required|string',

            'instructors' => 'required|array',
            'instructors.*' => 'exists:instructor_infos,id',

            'start_times.*' => 'required|date_format:H:i',
            'end_times.*' => 'required|date_format:H:i|after:start_times.*',
            'days.*' => 'required|integer|between:0,6',
            'locations.*' => 'required|exists:locations,id',
        ]);

        $danceStyle = DanceStyle::firstOrCreate(['name' => \request('danceStyle')]);

        $difficulty = Difficulty::firstOrCreate(['name' => \request('difficulty')], ['name' => \request('difficulty'), 'sorting_index' => (Difficulty::all()->count()+1)]);

        $uploadedFile = $request->file('cover_image');
        $fileName = time() . '_' . $uploadedFile->getClientOriginalName();
        $request->file('cover_image')->storeAs('/lesson/image', $fileName, 'public');

        $lesson = new Lesson();
        $lesson->name = \request("name");
        $lesson->short_description = \request("short_description");
        $lesson->long_description = \request("long_description");
        $lesson->age_min = \request("age_min");
        $lesson->age_max = \request("age_max");
        $lesson->season_start = \request("season_start");
        $lesson->season_end = \request("season_end");
        $lesson->price = \request("price");
        $lesson->dance_style_id = $danceStyle->id;
        $lesson->difficulty_id = $difficulty->id;
        $lesson->cover_img_path = 'storage/lesson/image/'.$fileName;

        $lesson->save();

        $lesson->instructors()->attach(\request('instructors'));



        foreach ($request->input('start_times') as $index => $startTime) {
            $lessonTimeLocation = new LessonTimeLocation();
            $lessonTimeLocation->week_day = $request->input('days')[$index];
            $lessonTimeLocation->start_time = Carbon::parse($startTime)->format('H:s');
            $lessonTimeLocation->end_time = Carbon::parse($request->input('end_times')[$index])->format('H:s');
            $lessonTimeLocation->location_id = $request->input('locations')[$index];
            $lessonTimeLocation->lesson_id = $lesson->id; // Associate the lesson ID
            $lessonTimeLocation->save();
            $lesson->lessonTimeLocations()->save($lessonTimeLocation);
        }

        return redirect()->route('admin.lesson.index')->with('success', 'Lesson and timeslots created successfully!');
    }

}
