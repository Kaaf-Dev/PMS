<?php

namespace Database\Seeders;

use App\Models\MaintenanceCompany;
use Illuminate\Database\Seeder;

class MaintenanceCompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MaintenanceCompany::factory()->count(3)->create();
    }
}
