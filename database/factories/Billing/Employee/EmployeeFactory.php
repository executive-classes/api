<?php

namespace Database\Factories\Billing\Employee;

use App\Enums\Billing\EmployeePositionEnum;
use App\Models\Eloquent\Billing\User\User;
use App\Models\Eloquent\Billing\Employee\Employee;
use Database\Factories\Billing\Employee\EmployeeFactoryStates;
use App\Models\Eloquent\Billing\EmployeePosition\EmployeePosition;
use Database\Factories\Factory;

class EmployeeFactory extends Factory
{
    use EmployeeFactoryStates;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->relation(User::class),
            'employee_position_id' => EmployeePositionEnum::getRandomValue()
        ];
    }
}
