<?php

namespace Database\Factories\Billing\PaymentInterval;

use App\Enums\Billing\PaymentIntervalEnum;
use App\Models\Eloquent\Billing\PaymentInterval\PaymentInterval;
use Database\Factories\Factory;

class PaymentIntervalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentInterval::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => PaymentIntervalEnum::getRandomValue()
        ];
    }
}