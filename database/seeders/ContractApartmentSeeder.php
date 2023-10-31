<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Contract;
use Illuminate\Database\Seeder;

class ContractApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all apartments from the database
        $apartments = Apartment::all();

        // Create contracts and associate with existing apartments
        $contracts = Contract::factory()->count(10)->create();

        foreach ($contracts as $contract) {
            $randomApartments = $apartments->random(rand(1, 5));
            $contract->apartments()->attach($randomApartments);
        }
    }
}
