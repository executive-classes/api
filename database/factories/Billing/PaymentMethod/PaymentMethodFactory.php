<?php

namespace Database\Factories\Billing\PaymentMethod;

use App\Enums\Billing\PaymentMethodEnum;
use App\Models\Eloquent\Billing\PaymentMethod\PaymentMethod;
use Database\Factories\Factory;

class PaymentMethodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentMethod::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => PaymentMethodEnum::getRandomValue(),
            'invoice_code' => $this->faker->numberBetween(0, 20)
        ];
    }
}