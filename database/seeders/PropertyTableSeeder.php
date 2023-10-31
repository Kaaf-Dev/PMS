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
            ->count(25)
            ->create()->each(function ($property) {
                //create 8 apartments for each Property
                Apartment::factory()
                    ->count(rand(4, 24))->create(['property_id'=>$property->id]);
            });;
    }
}
