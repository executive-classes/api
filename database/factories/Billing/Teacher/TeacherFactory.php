<?php

namespace Database\Factories\Billing\Teacher;

use App\Enums\Billing\TeacherStatusEnum;
use App\Models\Billing\Teacher\Teacher;
use App\Models\Billing\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
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
            'user_id' => User::factory()
        ];
    }

    /**
     * Indicate that the teacher is active.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'teacher_status_id' => TeacherStatusEnum::ACTIVE,
            ];
        });
    }

    /**
     * Indicate that the teacher is suspended.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function suspended()
    {
        return $this->state(function (array $attributes) {
            return [
                'teacher_status_id' => TeacherStatusEnum::SUSPENDED,
            ];
        });
    }

    /**
     * Indicate that the teacher is canceled.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function canceled()
    {
        return $this->state(function (array $attributes) {
            return [
                'teacher_status_id' => TeacherStatusEnum::CANCELED,
            ];
        });
    }
}
