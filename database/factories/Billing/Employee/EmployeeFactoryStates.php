<?php

namespace Database\Factories\Billing\Employee;

use App\Enums\Billing\EmployeeStatusEnum;
use App\Enums\Billing\EmployeePositionEnum;

trait EmployeeFactoryStates
{

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
     * Indicate that the employee is has a technician position.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function technician()
    {
        return $this->state(function (array $attributes) {
            return [
                'employee_position_id' => EmployeePositionEnum::TECHNICIAN,
            ];
        });
    }

    /**
     * Indicate that the employee is has a HR position.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function HR()
    {
        return $this->state(function (array $attributes) {
            return [
                'employee_position_id' => EmployeePositionEnum::HR,
            ];
        });
    }
}