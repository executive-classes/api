<?php

namespace Database\Factories\Billing\Student;

use App\Enums\Billing\StudentStatusEnum;

trait StudentFactoryStates
{
    /**
     * Indicate that the student is active.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'student_status_id' => StudentStatusEnum::ACTIVE,
            ];
        });
    }

    /**
     * Indicate that the student is suspended.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function suspended()
    {
        return $this->state(function (array $attributes) {
            return [
                'student_status_id' => StudentStatusEnum::SUSPENDED,
            ];
        });
    }

    /**
     * Indicate that the student is canceled.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function canceled()
    {
        return $this->state(function (array $attributes) {
            return [
                'student_status_id' => StudentStatusEnum::CANCELED,
            ];
        });
    }
}