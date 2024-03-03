<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::All();
        return view('rolesAndPermissions.roles', compact('roles'));
    }

    public function create()
    {
        return view('rolesAndPermissions.rolesCreate');
    }

    //Post
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|min:2',
        ]);

        Role::create([
            'name' => $request->input('name')
        ]);

        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully');
    }

    //Get edit view
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('rolesAndPermissions.rolesEdit', compact('role', 'permissions'));
    }

    //PUT for edit
    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'required|string|min:2',
        ]);
        $role->update($data);
        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully');
    }

    //Assign a permission to the role
    public function assignPermission(Request $request, Role $role)
    {
        if ($role->hasPermissionTo($request->permission)) {
            return back()->with('message', 'Permission already assigned to Role');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message', 'Permission added to role');
    }

    public function removePermission(Role $role,Permission $permission){
        if ($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back()->with('message','Permission removed from role');
        }
        return back()->with('message','Permission hasn\'t been assigned to role');
    }
}
