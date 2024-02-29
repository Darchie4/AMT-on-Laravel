<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::all()->each(function (Role $role) {
            $rand = rand(1, 9);
            for ($i = 0; $i < $rand; $i++) {
                $rolePermission = new RolePermission();
                $rolePermission->role_id = $role->id;
                $rolePermission->permission_id = Permission::inRandomOrder()->first()->id;
                $rolePermission->save();
            }
        });
    }
}
