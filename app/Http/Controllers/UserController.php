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
        return view('users.index', compact('users','roles','selectedRoles'));
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

        return view('users.index', compact('users', 'roles', 'selectedRoles'));
    }

    //Get create new user view
    public function create()
    {
        return view();
    }

    //POST create new user
    public function store()
    {
    }

    //Show details about user
    public function show()
    {
    }

    //Get edit view
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    //Edit a user (put/patch)
    public function update()
    {
    }

    //delete a user
    public function destroy()
    {
    }

    //Roles and permissions

    //add new role to user
    public function assignRole(Request $request, User $user)
    {
        if ($user->hasRole($request->role)) {
            return back()->with('message', 'Role already assigned to user');
        }
        $user->assignRole($request->role);
        return back()->with('message', 'Role added to user');
    }

    //remove existing role from user
    public function removeRole(User $user, Role $role): RedirectResponse
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->with('message', 'Role removed from user');
        }
        return back()->with('message', 'Role has not been assigned to user');
    }
}
