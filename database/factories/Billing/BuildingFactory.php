<?php

namespace Database\Factories\Billing;

use App\Models\Billing\Building;
use Illuminate\Database\Eloquent\Factories\Factory;

class BuildingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Building::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'zip_code' => $this->faker->postcode,
            'address' => $this->faker->streetName,
            'number' => $this->faker->buildingNumber,
            'city' => $this->faker->city,
            'state' => $this->faker->stateAbbr,
            'country' => $this->faker->country,
        ];
    }
}
