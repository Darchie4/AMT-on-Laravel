<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;



class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view('rolesAndPermissions.permissions',compact('permissions'));
    }
    public function create(){
        return view('rolesAndPermissions.permissionsCreate');
    }

    //Post
    public function store(Request $request) : RedirectResponse{
        $request->validate([
            'name' => 'required|string|min:2',
        ]);

        $permission = Permission::create([
            'name' => $request->input('name')
        ]);

        return redirect()->route('admin.permissions.index')->with('success','Permission created successfully');
    }
}
