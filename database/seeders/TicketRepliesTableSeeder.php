<?php

namespace Database\Seeders;

use App\Models\TicketReply;
use Illuminate\Database\Seeder;

class TicketRepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TicketReply::factory()->count(50)->create();
    }
}
