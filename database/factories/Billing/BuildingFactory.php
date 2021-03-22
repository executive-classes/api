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
            'street' => $this->faker->streetName,
            'number' => $this->faker->buildingNumber,
            'city' => $this->faker->city,
            'city_code' => $this->faker->numberBetween(0,9999999),
            'state' => $this->faker->stateAbbr,
            'state_code' => $this->faker->numberBetween(0,99),
            'country' => $this->faker->country,
            'country_code' => $this->faker->numberBetween(0,9999),
        ];
    }
}
