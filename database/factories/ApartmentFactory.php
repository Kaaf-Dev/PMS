<?php

namespace Database\Factories;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApartmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Apartment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = $this->faker->randomElement([1, 2]);

        $data = [
            'type' => $type,
            'name' => $this->faker->streetSuffix . ' - ' . $this->faker->buildingNumber,
            'cost' => $this->faker->randomFloat(2, 50, 500),
            'area' => $this->faker->randomFloat(2, 70, 250),
        ];

        if ($type == 1) { // house
            $data['rooms_count'] = $this->faker->randomNumber(1);
            $data['bathrooms_count'] = $this->faker->randomNumber(1);
        }

        return $data;
    }

}
