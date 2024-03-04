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

        //Check if already exists
        if (Permission::where('name', '=', $request->input('name'))->exists()) {
            return redirect()->back()->with('error','Permission with this name already exist');
        }

        Permission::create([
            'name' => $request->input('name')
        ]);

        return redirect()->route('admin.permissions.index')->with('success','Permission created successfully');
    }

    //Get edit view
    public function edit(Permission $permission){
        return view('rolesAndPermissions.permissionsEdit',compact('permission'));
    }

    //PUT for edit
    public function update(Request $request, Permission $permission){
        $data = $request->validate([
            'name' => 'required|string|min:2',
        ]);
        $permission->update($data);
        return redirect()->route('admin.permissions.index')->with('success','Permission updated successfully');

    }
}
