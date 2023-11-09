<?php

namespace Database\Seeders;

use App\Models\Nationality;
use Illuminate\Database\Seeder;

class NationalitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nationalities = [
            'بحريني',
            'سعودي',
            'يمني',
            'عراقي',
            'عُماني',
            'أردني',
        ];

        foreach ($nationalities as $nationality){
            Nationality::create([
                'name' => $nationality,
            ]);
        }
    }
}
