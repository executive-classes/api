<?php

namespace Database\Factories\Billing\Teacher;

use App\Models\Eloquent\Billing\User\User;
use App\Models\Eloquent\Billing\Teacher\Teacher;
use Database\Factories\Billing\Teacher\TeacherFactoryStates;
use Database\Factories\Factory;

class TeacherFactory extends Factory
{
    use TeacherFactoryStates;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Teacher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->relation(User::class)
        ];
    }
}
