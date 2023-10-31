<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\MaintenanceCompany;
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
        $adminIds = Admin::pluck('id')->toArray();
        $maintenanceCompaniesIds = MaintenanceCompany::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();

        $author_type = $this->faker->randomElement([
            'admin',
            'maintenance_company',
            'user',
        ]);

        return [
            'ticket_id' => $this->faker->randomElement($ticketIds),
            'admin_id' => ($author_type == 'admin') ? $this->faker->randomElement($adminIds) : null,
            'maintenance_company_id' => ($author_type == 'maintenance_company') ? $this->faker->randomElement($maintenanceCompaniesIds) : null,
            'user_id' => ($author_type == 'user') ? $this->faker->randomElement($userIds) : null,
            'content' => $this->faker->paragraph,
        ];
    }
}
