<?php

namespace App\Http\Controllers;

use App\Models\InstructorInfo;
use App\Models\Lesson;
use App\Models\Location;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class LessonController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function adminIndex(): Renderable
    {
        return view('lesson/admin/index', ['lessons' =>Lesson::all()]);
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function adminCreate(): Renderable
    {
        return view('lesson/admin/create', ['instructors' => InstructorInfo::all(), 'locations' => Location::all()]);
    }

}
