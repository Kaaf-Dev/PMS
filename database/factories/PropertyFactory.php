<?php

namespace Database\Factories;

use App\Models\Category;
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
            'category_id' => $this->faker->randomElement($categoryIds = Category::pluck('id')->toArray()),
            'name' => $this->faker->streetSuffix . ' - ' . $this->faker->buildingNumber,
            'floors_count' => $this->faker->randomFloat(0, 1, 12),
            'area' => $this->faker->randomFloat(2, 70, 250),
            'construction_date' => $this->faker->randomFloat(0, 1970, 2020),
        ];
    }

}
