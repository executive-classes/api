<?php

namespace Database\Factories\Billing\Employee;

use App\Enums\Billing\EmployeePositionEnum;
use App\Enums\Billing\EmployeeStatusEnum;
use App\Models\Eloquent\Billing\User\User;
use App\Models\Eloquent\Billing\Employee\Employee;
use Database\Factories\Billing\Employee\EmployeeFactoryStates;
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
            'id' => $this->id(),
            'user_id' => $this->relation(User::class),
            'employee_status_id' => $this->faker->randomElement(EmployeeStatusEnum::getUpdatableValues()),
            'employee_position_id' => EmployeePositionEnum::getRandomValue(),
        ];
    }
}
