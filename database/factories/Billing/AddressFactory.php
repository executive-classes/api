<?php

namespace Database\Factories\Billing;

use App\Enums\Billing\CountryEnum;
use App\Models\Billing\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'zip' => $this->faker->postcode,
            'street' => $this->faker->streetName,
            'number' => $this->faker->buildingNumber,
            'district' => $this->faker->text(20),
            'city' => $this->faker->city,
            'state' => $this->faker->stateAbbr,
            'country' => CountryEnum::getRandomValue(),
        ];
    }

    /**
     * Indicate that the address is from Brazil.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function br()
    {
        return $this->state(function (array $attributes) {
            return [
                'country' => CountryEnum::BR,
            ];
        });
    }

    /**
     * Indicate that the address is from United States.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function us()
    {
        return $this->state(function (array $attributes) {
            return [
                'country' => CountryEnum::US,
            ];
        });
    }
}
