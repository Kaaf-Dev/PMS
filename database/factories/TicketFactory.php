<?php

namespace Database\Factories;

use App\Models\Contract;
use App\Models\MaintenanceCompany;
use App\Models\Ticket;
use App\Models\TicketCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $ticketCategoryIds = TicketCategory::pluck('id')->toArray();
        $contractsIds = Contract::pluck('id')->toArray();
        $maintenanceCompaniesIds = MaintenanceCompany::pluck('id')->toArray();
        $status = $this->faker->randomElement(Ticket::getStatusValues());
        return [
            'id' => Str::uuid(),
            'contract_id' => $this->faker->randomElement($contractsIds),
            'maintenance_company_id' => ($status >= Ticket::STATUS_UNDER_PROCESSING) ? $this->faker->randomElement($maintenanceCompaniesIds) : null,
            'ticket_category_id' => $this->faker->randomElement($ticketCategoryIds),
            'subject' => $this->faker->sentence,
            'status' => $status,
            'description' => $this->faker->paragraph,
            'visit_at' => $this->faker->dateTimeThisYear,
            'visited_at' => $this->faker->dateTimeThisYear,
        ];
    }
}
