<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //Basic crud
    public function index(Request $request)
    {
        $usersQuery = User::query();
        $roles = Role::all();
        if ($request->has('search')) {
            $search = $request->input('search');
            $usersQuery->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('lname', 'like', '%' . $search . '%');
        }

        $users = $usersQuery->get();
        $selectedRoles = [];
        return view('users.admin.index', compact('users','roles','selectedRoles'));
    }

    //Method for filtering for roles
    public function filter(Request $request){
        $selectedRoles = $request->input('roles', []);

        $query = User::query();

        if (!empty($selectedRoles)) {
            $query->whereHas('roles', function ($query) use ($selectedRoles) {
                $query->whereIn('name', $selectedRoles);
            });
        }

        $users = $query->get();
        $roles = Role::all();

        return view('users.admin.index', compact('users', 'roles', 'selectedRoles'));
    }

    //Get create new user view
    public function create()
    {
        return view('users.admin.create');
    }

    //POST create new user
    public function store()
    {
    }

    //Show details about user
    public function show(User $user)
    {
        return view('users.admin.details',compact('user'));
    }

    //Get edit view
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.admin.edit', compact('user', 'roles'));
    }

    //Edit a user (put/patch)
    public function update(Request $request, $id)
    {
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
    public function destroy(int $id)
    {
        User::destroy($id);
        return back()->with('message','User deleted');
    }

    //Roles and permissions

    //add new role to user
    public function assignRole(Request $request, User $user)
    {
        if ($user->hasRole($request->role)) {
            return back()->with('error', 'Role already assigned to user');
        }
        $user->assignRole($request->role);
        return back()->with('success', 'Role added to user');
    }

    //remove existing role from user
    public function removeRole(User $user, Role $role): RedirectResponse
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->with('success', 'Role removed from user');
        }
        return back()->with('error', 'Role has not been assigned to user');
    }
}
