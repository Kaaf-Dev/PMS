<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->streetSuffix . ' - ' . $this->faker->buildingNumber,
            'floors_count' => $this->faker->randomNumber(1),
            'area' => $this->faker->randomFloat(2, 70, 250),
            'construction_date' => $this->faker->dateTimeBetween('-30 years', 'now'),
        ];
    }

}
