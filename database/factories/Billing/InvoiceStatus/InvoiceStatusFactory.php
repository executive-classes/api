<?php

namespace Database\Factories\Billing\InvoiceStatus;

use App\Enums\Billing\InvoiceStatusEnum;
use App\Models\Eloquent\Billing\InvoiceStatus\InvoiceStatus;
use Database\Factories\Factory;

class InvoiceStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoiceStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => InvoiceStatusEnum::getRandomValue()
        ];
    }
}