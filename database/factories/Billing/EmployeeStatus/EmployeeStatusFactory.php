<?php

namespace Database\Factories\Billing\EmployeeStatus;

use App\Enums\Billing\EmployeeStatusEnum;
use App\Models\Eloquent\Billing\EmployeeStatus\EmployeeStatus;
use Database\Factories\Factory;

class EmployeeStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmployeeStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => EmployeeStatusEnum::getRandomValue()
        ];
    }
}