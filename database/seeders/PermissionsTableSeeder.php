<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'client_create',
            ],
            [
                'id'    => 18,
                'title' => 'client_edit',
            ],
            [
                'id'    => 19,
                'title' => 'client_show',
            ],
            [
                'id'    => 20,
                'title' => 'client_delete',
            ],
            [
                'id'    => 21,
                'title' => 'client_access',
            ],
            [
                'id'    => 22,
                'title' => 'employee_create',
            ],
            [
                'id'    => 23,
                'title' => 'employee_edit',
            ],
            [
                'id'    => 24,
                'title' => 'employee_show',
            ],
            [
                'id'    => 25,
                'title' => 'employee_delete',
            ],
            [
                'id'    => 26,
                'title' => 'employee_access',
            ],
            [
                'id'    => 27,
                'title' => 'working_hour_create',
            ],
            [
                'id'    => 28,
                'title' => 'working_hour_edit',
            ],
            [
                'id'    => 29,
                'title' => 'working_hour_show',
            ],
            [
                'id'    => 30,
                'title' => 'working_hour_delete',
            ],
            [
                'id'    => 31,
                'title' => 'working_hour_access',
            ],
            [
                'id'    => 32,
                'title' => 'appointment_create',
            ],
            [
                'id'    => 33,
                'title' => 'appointment_edit',
            ],
            [
                'id'    => 34,
                'title' => 'appointment_show',
            ],
            [
                'id'    => 35,
                'title' => 'appointment_delete',
            ],
            [
                'id'    => 36,
                'title' => 'appointment_access',
            ],
            [
                'id'    => 37,
                'title' => 'project_create',
            ],
            [
                'id'    => 38,
                'title' => 'project_edit',
            ],
            [
                'id'    => 39,
                'title' => 'project_show',
            ],
            [
                'id'    => 40,
                'title' => 'project_delete',
            ],
            [
                'id'    => 41,
                'title' => 'project_access',
            ],
            [
                'id'    => 42,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
