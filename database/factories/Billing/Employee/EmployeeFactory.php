<?php

namespace Database\Factories\Billing\Employee;

use App\Models\Eloquent\Billing\User\User;
use App\Models\Eloquent\Billing\Employee\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Billing\Employee\EmployeeFactoryStates;
use App\Models\Eloquent\Billing\EmployeePosition\EmployeePosition;

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
            'user_id' => User::factory(),
            'employee_position_id' => EmployeePosition::inRandomOrder()->first()
        ];
    }
}
