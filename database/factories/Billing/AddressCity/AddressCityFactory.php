<?php

namespace Database\Factories\Billing\AddressCity;

use App\Models\Eloquent\Billing\AddressCity\AddressCity;
use App\Models\Eloquent\Billing\AddressState\AddressState;
use Database\Factories\Factory;

class AddressCityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AddressCity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->city,
            'capital' => $this->faker->boolean(20),
            'state' => $this->relation(AddressState::class)
        ];
    }
}