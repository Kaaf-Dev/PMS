<?php

namespace Database\Factories;

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

        return [
            'id' => Str::uuid(),
            'ticket_category_id' => $this->faker->randomElement($ticketCategoryIds),
            'subject' => $this->faker->sentence,
            'status' => $this->faker->randomElement([1, 2, 3]),
            'description' => $this->faker->paragraph,
            'visit_at' => $this->faker->dateTimeThisYear,
            'visited_at' => $this->faker->dateTimeThisYear,
        ];
    }
}
