<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketReplyFactory extends Factory
{

    protected $model = TicketReply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ticketIds = Ticket::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();
        $adminIds = Admin::pluck('id')->toArray();

        return [
            'ticket_id' => $this->faker->randomElement($ticketIds),
            'user_id' => $this->faker->randomElement($userIds),
            'admin_id' => $this->faker->randomElement($adminIds),
            'content' => $this->faker->paragraph,
        ];
    }
}
