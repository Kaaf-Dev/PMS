<?php

namespace Database\Factories;

use App\Models\Contract;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractFactory extends Factory
{

    protected $model = Contract::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_ids = User::pluck('id')->toArray();

        return [
            'user_id' => $this->faker->randomElement($user_ids),
            'cost' => $this->faker->randomFloat(2, 100, 1000),
            'active' => $this->faker->boolean,
            'start_at' => Carbon::now(),
            'end_at' => Carbon::now()->addYear(),
        ];
    }
}
