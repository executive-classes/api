<?php

namespace Database\Factories\Billing;

use App\Models\Billing\Employee;
use App\Models\Billing\EmployeePosition;
use App\Models\Billing\User;
use Database\Seeders\Billing\UserSeeder;
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
            'employee_position_id' => $this->faker->randomElement(EmployeePosition::all()),
            'user_id' => $this->faker->unique()->randomElement(User::where('email', '<>', UserSeeder::TEST_EMAIL)->get())
        ];
    }
}
