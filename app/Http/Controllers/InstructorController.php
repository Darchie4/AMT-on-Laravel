<?php

namespace App\Http\Controllers;

use App\Models\InstructorInfo;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class InstructorController extends Controller
{
    public function index(Request $request){
        $instructorsQuery = InstructorInfo::query()->with('user');
        $roles = Role::all();
        if ($request->has('search')) {
            $search = $request->input('search');
            $instructorsQuery->whereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            })->orWhere('lname', 'like', '%' . $search . '%');
        }
        $instructors = $instructorsQuery->get();
        $selectedRoles = [];
        return view('instructors.admin.index',compact('instructors','roles','selectedRoles'));
    }

    public function show(int $id){

        $instructor = InstructorInfo::findOrFail($id);
        $user = $instructor->user();
        return view('instructors.admin.details',compact('instructor','user'));
    }

    public function edit(int $id)
    {
        $thisuser = optional(Auth::user()->instructorInfo)->id;
        $instructor = InstructorInfo::findOrFail($id);
        if ($thisuser == $id || Auth::user()->can('admin_panel')){
            return view('instructors.admin.edit', ['instructor'=> $instructor,'roles' => Role::all()]);
        }
        else{
            return abort(403);
        }
    }

    //Edit a user (put/patch)
    public function update(Request $request, int $id): RedirectResponse
    {
        $instructor = InstructorInfo::findOrFail($id);
        $user = $instructor->user;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date'],
            'gender' => ['required', 'string', 'max:255'],
            'short_description' =>['string'],
            'long_description' => ['string'],
            'profile_img_path'=>['required','max:2048']
        ]);

        $user->update([
            'name' => $request->input('name'),
            'lname' => $request->input('lname'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'birthday' => $request->input('birthday'),
            'gender' => $request->input('gender')
        ]);

        $instructor->short_description = $request->input('short_description');
        $instructor->long_description = $request->input('long_description');
        //$instructor->profile_img_path=$request->input('profile_img_path');

        // Update cover image if provided
        if ($request->hasFile('profile_img_path')) {
            $uploadedFile = $request->file('profile_img_path');
            $fileName = time() . '_' . $uploadedFile->getClientOriginalName();
            $request->file('profile_img_path')->storeAs('/instructor/image', $fileName, 'public');
            $instructor->profile_img_path = 'storage/instructor/image/' . $fileName;
        }
        $instructor->save();

        return redirect()->route('admin.instructors.index')->with('success', 'Instructor updated successfully');
    }

    public function create(){
        return view('instructors.admin.create',['users'=>User::all()]);
    }
    public function store(Request $request){
        $request->validate([
            'short_description' => 'required|string|min:2',
            'long_description'=>'string',
            'profile_img_path'=>'nullable|image|mimes:jpeg,png|max:2048',
            'user_id' =>'required|exists:users,id'
        ]);

        InstructorInfo::create([
            'short_description'=>$request->input('short_description'),
            'long_description' => $request->input('long_description'),
            'profile_img_path' => $request->input('profile_img_path'),
            'user_id' => $request->input('user_id')
        ]);

        return redirect()->route('admin.instructors.index')->with('success', 'Instructor created successfully');
    }

    public function destroy(int $id){
        InstructorInfo::destroy($id);
        return back()->with('success','Instructor deleted');
    }
}
