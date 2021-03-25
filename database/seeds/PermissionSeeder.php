<?php

use App\Photo;
use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'user_management_create']);
        Permission::create(['name' => 'user_management_view']);
        Permission::create(['name' => 'user_management_update']);
        Permission::create(['name' => 'user_management_delete']);

        Permission::create(['name' => 'patient_management_create']);
        Permission::create(['name' => 'patient_management_view']);
        Permission::create(['name' => 'patient_management_update']);
        Permission::create(['name' => 'patient_management_delete']);

        Permission::create(['name' => 'employee_management_create']);
        Permission::create(['name' => 'employee_management_view']);
        Permission::create(['name' => 'employee_management_update']);
        Permission::create(['name' => 'employee_management_delete']);

        Permission::create(['name' => 'role_management_create']);
        Permission::create(['name' => 'role_management_view']);
        Permission::create(['name' => 'role_management_update']);
        Permission::create(['name' => 'role_management_delete']);

        Permission::create(['name' => 'dashboard_management_create']);
        Permission::create(['name' => 'dashboard_management_view']);
        Permission::create(['name' => 'dashboard_management_update']);
        Permission::create(['name' => 'dashboard_management_delete']);




        //Create Super Admin Account & Super Admin Role

        Photo::create([
            'user_id' => '1'
        ]);

        $supermin_role = Role::create(['name' => 'Super Admin']);

        $supermin = User::create([
            'username' => 'admin',
            'email' => 'admin@email.com',
            'password' => 'password',
        ]);
        $supermin->syncRoles($supermin_role);

    }
}
