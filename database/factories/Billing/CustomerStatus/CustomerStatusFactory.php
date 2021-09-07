<?php

namespace Database\Factories\Billing\CustomerStatus;

use App\Enums\Billing\CustomerStatusEnum;
use App\Models\Eloquent\Billing\CustomerStatus\CustomerStatus;
use Database\Factories\Factory;

class CustomerStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => CustomerStatusEnum::getRandomValue()
        ];
    }
}