<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Property::factory()
            ->has(Apartment::factory()->count(10), 'apartments')
            ->count(25)
            ->create();
    }
}
