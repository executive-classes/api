<?php

namespace Database\Factories\Billing\AddressState;

use App\Enums\Billing\StateEnum;
use App\Models\Eloquent\Billing\AddressState\AddressState;
use Database\Factories\Factory;

class AddressStateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AddressState::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->numberBetween(10, 55),
            'short_name' => StateEnum::getRandomValue(),
            'name' => $this->faker->state,
            'ie_mask' => '##########'
        ];
    }
}