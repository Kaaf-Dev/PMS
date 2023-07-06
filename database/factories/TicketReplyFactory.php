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

        $for_admin = rand(0, 1);

        return [
            'ticket_id' => $this->faker->randomElement($ticketIds),
            'user_id' => ($for_admin == 0) ? $this->faker->randomElement($userIds) : null,
            'admin_id' => ($for_admin == 1) ? $this->faker->randomElement($adminIds) : null,
            'content' => $this->faker->paragraph,
        ];
    }
}
