<?php

namespace Database\Factories\Billing\Teacher;

use App\Enums\Billing\TeacherStatusEnum;

trait TeacherFactoryStates
{
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