<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //Basic crud
    public function index(){
        $users = User::all();
        return view('users.admin.index',compact('users'));
    }

    //Get create new user view
    public function create(){
        return view();
    }

    //POST create new user
    public function store(){
    }

    //Show details.blade.php about user
    public function show(User $user){
        return view('users.admin.details',compact('user'));
    }

    //Get edit view
    public function edit(User $user){
        $roles = Role::all();
        return view('users.admin.edit',compact('user','roles'));
    }
    //Edit a user (put/patch)
    public function update(Request $request,$id){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users')->ignore($id)],
            'phone' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date'],
            'gender' => ['required', 'string', 'max:255'],
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->input('name'),
            'lname' => $request->input('lname'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'birthday' => $request->input('birthday'),
            'gender' => $request->input('gender')
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    //delete a user
    public function destroy(){
    }

    //Roles and permissions

    //add new role to user
    public function assignRole(Request $request, User $user){
        if ($user->hasRole($request->role)) {
            return back()->with('error', 'Role already assigned to user');
        }
        $user->assignRole($request->role);
        return back()->with('success', 'Role added to user');
    }

    //remove existing role from user
    public function removeRole(User $user, Role $role) : RedirectResponse{
        if ($user->hasRole($role)){
            $user->removeRole($role);
            return back()->with('success','Role removed from user');
        }
        return back()->with('error','Role has not been assigned to user');
    }
}
