<?php

namespace Database\Factories\Billing;

use App\Enums\Billing\EmployeePositionEnum;
use App\Enums\Billing\EmployeeStatusEnum;
use App\Models\Billing\Employee;
use App\Models\Billing\EmployeePosition;
use App\Models\Billing\EmployeeStatus;
use App\Models\Billing\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
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

    /**
     * Indicate that the employee is active.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'employee_status_id' => EmployeeStatusEnum::ACTIVE,
            ];
        });
    }

    /**
     * Indicate that the employee is suspended.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function suspended()
    {
        return $this->state(function (array $attributes) {
            return [
                'employee_status_id' => EmployeeStatusEnum::SUSPENDED,
            ];
        });
    }

    /**
     * Indicate that the employee is canceled.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function canceled()
    {
        return $this->state(function (array $attributes) {
            return [
                'employee_status_id' => EmployeeStatusEnum::CANCELED,
            ];
        });
    }

    /**
     * Indicate that the employee is inactive.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function inactive()
    {
        return $this->state(function (array $attributes) {
            return [
                'employee_status_id' => EmployeeStatusEnum::INACTIVE,
            ];
        });
    }

    /**
     * Indicate that the employee is has a administrator position.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function administrator()
    {
        return $this->state(function (array $attributes) {
            return [
                'employee_position_id' => EmployeePositionEnum::ADMINISTRATOR,
            ];
        });
    }

    /**
     * Indicate that the employee is has a financial position.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function financial()
    {
        return $this->state(function (array $attributes) {
            return [
                'employee_position_id' => EmployeePositionEnum::FINANCIAL,
            ];
        });
    }

    /**
     * Indicate that the employee is has a developer position.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function developer()
    {
        return $this->state(function (array $attributes) {
            return [
                'employee_position_id' => EmployeePositionEnum::DEVELOPER,
            ];
        });
    }
}
