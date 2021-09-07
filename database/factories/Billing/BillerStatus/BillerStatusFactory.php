<?php

namespace Database\Factories\Billing\BillerStatus;

use App\Enums\Billing\BillerStatusEnum;
use App\Models\Eloquent\Billing\BillerStatus\BillerStatus;
use Database\Factories\Factory;

class BillerStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BillerStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => BillerStatusEnum::getRandomValue()
        ];
    }
}