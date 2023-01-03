<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Admin::withTrashed()->count() == 0) { // generate admin when no admins in database
            $admin = new Admin();
            $admin->name = 'Admin';
            $admin->username = 'admin';
            $admin->password = Hash::make('12345678');
            $admin->save();
        }

    }
}
