<?php

namespace Database\Factories\Billing\EmployeePosition;

use Database\Factories\Factory;
use App\Enums\Billing\EmployeePositionEnum;
use App\Models\Eloquent\Billing\EmployeePosition\EmployeePosition;

class EmployeePositionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmployeePosition::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => EmployeePositionEnum::getRandomValue()
        ];
    }
}