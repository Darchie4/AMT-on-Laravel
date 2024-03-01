<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    protected static ?string $password;
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'lessons_can_crud']);
        Permission::create(['name' =>'lessons_instructor']);
        Permission::create(['name' => 'users_can_crud']);

        // create roles and assign created permissions
        // this can be done as separate statements
        $role1 = Role::create(['name' => 'admin']);
        $role1->givePermissionTo(Permission::all());

        // or may be done by chaining
        $role2 = Role::create(['name' => 'instructor'])
            ->givePermissionTo(['lessons_instructor']);

        $user = User::factory()->create([
            'name' => 'Example Admin User',
            'email' => 'admin@example.com',
            'password' => static::$password ??= Hash::make('password'),
        ]);
        $user->assignRole($role2);
    }
}
