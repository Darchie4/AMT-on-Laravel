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
    public function index(): Renderable
    {
        return view('lesson/public/index', ['lessons' => Lesson::all()]);
    }


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

    public function show(int $id): Renderable
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
            'price' => 'required|numeric|min:0',
            'cover_image' => 'nullable|image|mimes:jpeg,png|max:2048',
            'danceStyle' => 'required|string',
            'total_signup_space' => 'required|integer|min:0',
            'visible' => 'sometimes',
            'can_signup' => 'sometimes',
            'difficulty' => 'required|string',
            'sorting_index' => 'required|integer',

            'instructors' => 'required|array',
            'instructors.*' => 'exists:instructor_infos,id',

            'start_times.*' => 'required|date_format:H:i',
            'end_times.*' => 'required|date_format:H:i|after:start_times.*',
            'days.*' => 'required|integer|between:0,6',
            'locations.*' => 'required|exists:locations,id',
        ]);

        $danceStyle = DanceStyle::firstOrCreate(['name' => \request('danceStyle')]);

        $difficulty = Difficulty::firstOrCreate(['name' => $request->input('difficulty')], ['name' => \request('difficulty'), 'sorting_index' => $request->input('sorting_index')]);

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
        $lesson->total_signup_space = \request("total_signup_space");
        $lesson->visible = (\request("visible") != null);
        $lesson->can_signup = (\request("can_signup") != null);

        $lesson->save();

        $lesson->instructors()->attach(\request('instructors'));



        foreach ($request->input('start_times') as $index => $startTime) {
            $lessonTimeLocation = new LessonTimeLocation();
            $lessonTimeLocation->week_day = $request->input('days')[$index];
            $lessonTimeLocation->start_time = Carbon::parse($startTime)->format('H:i');
            $lessonTimeLocation->end_time = Carbon::parse($request->input('end_times')[$index])->format('H:i');
            $lessonTimeLocation->location_id = $request->input('locations')[$index];
            $lessonTimeLocation->lesson_id = $lesson->id; // Associate the lesson ID
            $lessonTimeLocation->save();
            $lesson->lessonTimeLocations()->save($lessonTimeLocation);
        }

        return redirect()->route('admin.lesson.index')->with('success', 'Lesson and timeslots created successfully!');
    }

    public function adminEdit(int $id): Renderable
    {
        $lesson = Lesson::findOrFail($id);
        return view('lesson/admin/edit', ['lesson'=> $lesson,'instructors' => InstructorInfo::all(), 'locations' => Location::all(), 'danceStyles' => DanceStyle::all(), 'difficulties' => Difficulty::all()]);
    }
    public function adminDoEdit(Request $request, int $lessonID): RedirectResponse
    {
        $lesson = Lesson::findOrFail($lessonID);
        $request->validate([
            'name' => 'required|string',
            'short_description' => 'required|string|max:255',
            'long_description' => 'required|string',
            'age_min' => 'required|integer',
            'age_max' => 'required|integer|gte:age_min',
            'season_start' => 'required|date',
            'season_end' => 'required|date|after_or_equal:season_start',
            'price' => 'required|numeric|min:0',
            'cover_image' => 'nullable|image|mimes:jpeg,png|max:2048',
            'danceStyle' => 'required|string',
            'difficulty' => 'required|string',
            'sorting_index' => 'sometimes|nullable|integer',
            'total_signup_space' => 'required|integer|min:0',
            'visible' => 'required',
            'can_signup' => 'required',

            'instructors' => 'required|array',
            'instructors.*' => 'exists:instructor_infos,id',

            'start_times.*' => 'required|date_format:H:i',
            'end_times.*' => 'required|date_format:H:i|after:start_times.*',
            'days.*' => 'required|integer|between:0,6',
            'locations.*' => 'required|exists:locations,id',
        ]);

        $lesson->name = $request->input("name");
        $lesson->short_description = $request->input("short_description");
        $lesson->long_description = $request->input("long_description");
        $lesson->age_min = $request->input("age_min");
        $lesson->age_max = $request->input("age_max");
        $lesson->season_start = $request->input("season_start");
        $lesson->season_end = $request->input("season_end");
        $lesson->price = $request->input("price");
        $lesson->total_signup_space = \request("total_signup_space");
        $lesson->visible = (\request("visible") != null);
        $lesson->can_signup = (\request("can_signup") != null);

        // Update dance style and difficulty
        $danceStyle = DanceStyle::firstOrCreate(['name' => $request->input('danceStyle')]);
        $lesson->dance_style_id = $danceStyle->id;
        if ($request->input('sorting_index')){
            $difficulty = Difficulty::updateOrCreate(['name' => $request->input('difficulty')], ['name' => $request->input('difficulty'), 'sorting_index' => $request->input('sorting_index')]);
            $lesson->difficulty_id = $difficulty->id;
        }

        // Update cover image if provided
        if ($request->hasFile('cover_image')) {
            $uploadedFile = $request->file('cover_image');
            $fileName = time() . '_' . $uploadedFile->getClientOriginalName();
            $request->file('cover_image')->storeAs('/lesson/image', $fileName, 'public');
            $lesson->cover_img_path = 'storage/lesson/image/' . $fileName;
        }

        $lesson->save();

        // Sync instructors
        $lesson->instructors()->sync($request->input('instructors'));

        // Update or create lesson time locations
        foreach ($request->input('start_times') as $index => $startTime) {
            LessonTimeLocation::updateOrCreate(
                ['lesson_id' => $lesson->id, 'week_day' => $request->input('days')[$index]],
                ['start_time' => Carbon::parse($startTime)->format('H:i'), 'end_time' => Carbon::parse($request->input('end_times')[$index])->format('H:i'), 'location_id' => $request->input('locations')[$index]]
            );
        }

        return redirect()->route('admin.lesson.index')->with('success', 'Lesson updated successfully!');
    }

    public function adminDelete(int $id) : RedirectResponse{

        $lesson = Lesson::findOrFail($id);
        $name = $lesson->name;
        $lesson->delete();

        return back()->with('message','The lesson: '.$name. ' has been deleted');
    }

    public function instructorDoEdit(Request $request, Lesson $lesson): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'short_description' => 'required|string|max:255',
            'long_description' => 'required|string',
            'age_min' => 'required|integer',
            'age_max' => 'required|integer|gte:age_min',
            'cover_image' => 'nullable|image|mimes:jpeg,png|max:2048',
            'danceStyle' => 'required|string',
            'difficulty' => 'required|string',
        ]);

        $lesson->name = $request->input("name");
        $lesson->short_description = $request->input("short_description");
        $lesson->long_description = $request->input("long_description");
        $lesson->age_min = $request->input("age_min");
        $lesson->age_max = $request->input("age_max");

        // Update dance style and difficulty
        $danceStyle = DanceStyle::firstOrCreate(['name' => $request->input('danceStyle')]);
        $lesson->dance_style_id = $danceStyle->id;

        $difficulty = Difficulty::updateOrCreate(['name' => $request->input('difficulty')], ['name' => $request->input('difficulty'), 'sorting_index' => $request->input('sorting_index')]);
        $lesson->difficulty_id = $difficulty->id;

        // Update cover image if provided
        if ($request->hasFile('cover_image')) {
            $uploadedFile = $request->file('cover_image');
            $fileName = time() . '_' . $uploadedFile->getClientOriginalName();
            $request->file('cover_image')->storeAs('/lesson/image', $fileName, 'public');
            $lesson->cover_img_path = 'storage/lesson/image/' . $fileName;
        }

        $lesson->save();

        return redirect()->route('admin.lesson.index')->with('success', 'Lesson updated successfully!');
    }

}
