<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::All();
        return view('rolesAndPermissions.roles', compact('roles'));
    }

    public function create(){
        return view('rolesAndPermissions.rolesCreate');
    }

    //Post
    public function store(Request $request) : RedirectResponse{
        $request->validate([
           'name' => 'required|string|min:2',
        ]);

        $role = Role::create([
            'name' => $request->input('name')
        ]);

        return redirect()->route('admin.roles.index')->with('success','Role created successfully');
    }
}
