<?php

namespace Database\Seeders;

use App\Models\Lawyer;
use Illuminate\Database\Seeder;

class LawyersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lawyer::factory()->count(3)->create();
    }
}
