<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    protected static ?string $password;
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'lessons_can_crud']);
        Permission::create(['name' =>'lessons_instructor']);
        Permission::create(['name' => 'users_crud']);
        Permission::create(['name' => 'admin_panel']);
        Permission::create(['name' => 'locations_crud']);
        Permission::create(['name' => 'lessons_own']);
        Permission::create(['name' => 'lessons_crud']);
        Permission::create(['name' => 'instructors_own']);
        Permission::create(['name' => 'instructors_crud']);
        Permission::create(['name' => 'roles_crud']);
        Permission::create(['name' => 'admin_dashboard']);
        Permission::create(['name' => 'permissions_crud']);
        Permission::create(['name' => 'registration_admin']);

        // create roles and assign created permissions
        // this can be done as separate statements
        $role1 = Role::create(['name' => 'admin']);
        $role1->givePermissionTo(Permission::all());

        // or may be done by chaining
        $role2 = Role::create(['name' => 'instructor'])
            ->givePermissionTo(['lessons_instructor',
                'lessons_own','instructors_own','admin_dashboard']);

        $address = new Address();
        $address->street_number = 1;
        $address->street_name = "Admin Street";
        $address->zip_code = 9999;
        $address->city = "Admin City";
        $address->country = "Admin Country";
        $address->save();


        $user = User::create([
            'name' => 'Example',
            'lname'=> 'Admin',
            'phone' => 123456789,
            'birthday' => now(),
            'gender' => "male",
            'address_id' => 1,
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole($role1);

        $super = Role::create(['name'=>'SuperAdmin']);
        $superuser = User::create([
            'name' => 'Super',
            'lname'=> 'Admin',
            'phone' => 123456788,
            'birthday' => now(),
            'gender' => "male",
            'address_id' => 1,
            'email' => 'superadmin@example.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        $superuser ->assignRole($super);
    }
}
