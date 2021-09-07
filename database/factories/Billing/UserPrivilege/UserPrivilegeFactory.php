<?php

namespace Database\Factories\Billing\UserPrivilege;

use Database\Factories\Factory;
use App\Enums\Billing\UserPrivilegeEnum;
use App\Models\Eloquent\Billing\UserPrivilege\UserPrivilege;

class UserPrivilegeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserPrivilege::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => UserPrivilegeEnum::getRandomValue(),
            'teacher_can' => $this->faker->boolean(),
            'student_can' => $this->faker->boolean()
        ];
    }
}