<?php

namespace Database\Factories\Billing\AddressCountry;

use App\Models\Eloquent\Billing\AddressCountry\AddressCountry;
use Database\Factories\Factory;

class AddressCountryFactory extends Factory
{
    use AddressCountryFactoryStates;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AddressCountry::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->numberBetween(100, 9999),
            'short_name' => $this->faker->countryCode,
            'active' => $this->faker->boolean(),
            'name' => $this->faker->country,
            'name_pt' => $this->faker->country,
        ];
    }
}