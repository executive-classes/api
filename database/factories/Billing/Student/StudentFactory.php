<?php

namespace Database\Factories\Billing\Student;

use App\Enums\Billing\StudentStatusEnum;
use App\Models\Billing\Biller\Biller;
use App\Models\Billing\Student\Student;
use App\Models\Billing\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'biller_id' => Biller::factory(),
            'customer_id' => function (array $attributes) {
                return Biller::find($attributes['biller_id'])->customer_id;
            },
            'user_id' => User::factory()
        ];
    }

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
