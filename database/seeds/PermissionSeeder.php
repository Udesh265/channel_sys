<?php

use App\JobType;
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

        Permission::create(['name' => 'doctordash_management_create']);
        Permission::create(['name' => 'doctordash_management_view']);
        Permission::create(['name' => 'doctordash_management_update']);
        Permission::create(['name' => 'doctordash_management_delete']);

        Permission::create(['name' => 'appointment_management_create']);
        Permission::create(['name' => 'appointment_management_view']);
        Permission::create(['name' => 'appointment_management_update']);
        Permission::create(['name' => 'appointment_management_delete']);

        Permission::create(['name' => 'labtest_management_create']);
        Permission::create(['name' => 'labtest_management_view']);
        Permission::create(['name' => 'labtest_management_update']);
        Permission::create(['name' => 'labtest_management_delete']);

        Permission::create(['name' => 'laboraty_management_create']);
        Permission::create(['name' => 'laboraty_management_view']);
        Permission::create(['name' => 'laboraty_management_update']);
        Permission::create(['name' => 'laboraty_management_delete']);

        Permission::create(['name' => 'settings_management_create']);
        Permission::create(['name' => 'settings_management_view']);
        Permission::create(['name' => 'settings_management_update']);
        Permission::create(['name' => 'settings_management_delete']);

        Permission::create(['name' => 'schedule_management_create']);
        Permission::create(['name' => 'schedule_management_view']);
        Permission::create(['name' => 'schedule_management_update']);
        Permission::create(['name' => 'schedule_management_delete']);

        Permission::create(['name' => 'doctor_management_create']);
        Permission::create(['name' => 'doctor_management_view']);
        Permission::create(['name' => 'doctor_management_update']);
        Permission::create(['name' => 'doctor_management_delete']);

        Permission::create(['name' => 'reception_management_create']);
        Permission::create(['name' => 'reception_management_view']);
        Permission::create(['name' => 'reception_management_update']);
        Permission::create(['name' => 'reception_management_delete']);


        Permission::create(['name' => 'attendance_management_create']);
        Permission::create(['name' => 'attendance_management_view']);
        Permission::create(['name' => 'attendance_management_update']);
        Permission::create(['name' => 'attendance_management_delete']);



        Permission::create(['name' => 'report_management_create']);
        Permission::create(['name' => 'report_management_view']);
        Permission::create(['name' => 'report_management_update']);
        Permission::create(['name' => 'report_management_delete']);

        Permission::create(['name' => 'managerdashboard_management_create']);
        Permission::create(['name' => 'managerdashboard_management_view']);
        Permission::create(['name' => 'managerdashboard_management_update']);
        Permission::create(['name' => 'managerdashboard_management_delete']);

        Permission::create(['name' => 'labdashboard_management_create']);
        Permission::create(['name' => 'labdashboard_management_view']);
        Permission::create(['name' => 'labdashboard_management_update']);
        Permission::create(['name' => 'labdashboard_management_delete']);

        Permission::create(['name' => 'repdashboard_management_create']);
        Permission::create(['name' => 'repdashboard_management_view']);
        Permission::create(['name' => 'repdashboard_management_update']);
        Permission::create(['name' => 'repdashboard_management_delete']);

















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

        $data = JobType::create([
            'name' => 'Doctor',
        ]);

    }
}
