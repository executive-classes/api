<?php

namespace Database\Factories\Billing\Address;

use Database\Factories\Factory;
use App\Enums\Billing\CountryEnum;
use App\Models\Eloquent\Billing\Address\Address;

class AddressFactory extends Factory
{
    use AddressFactoryStates;
    
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
}
