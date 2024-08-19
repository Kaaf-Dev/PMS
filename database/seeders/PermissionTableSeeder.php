<?php

namespace Database\Seeders;

use App\Models\Lawyer;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('permissions')->delete();
        $permissions = [
            [
                'name' => 'إدارة المستأجرين',
                'slug' => 'manage_users',
            ],
            [
                'name' => 'إدارة العقارات',
                'slug' => 'manage_properties',
            ],
            [
                'name' => 'إدارة الوحدات السكنية',
                'slug' => 'manage_apartments',
            ],
            [
                'name' => 'إدارة العقود',
                'slug' => 'manage_contracts',
            ],
            [
                'name' => 'إدارة المالية',
                'slug' => 'manage_invoices',
            ],
            [
                'name' => 'إدارة الصيانة',
                'slug' => 'manage_tickets',
            ],
            [
                'name' => 'إدارة الجهات القانونية',
                'slug' => 'manage_lawyers',
            ],
            [
                'name' => 'إدارة الموظفين',
                'slug' => 'manage_admins',
            ],
            [
                'name' => 'إدارة الصلاحيات',
                'slug' => 'manage_roles',
            ],
            [
                'name' => 'إدارة التقارير',
                'slug' => 'manage_reports',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
