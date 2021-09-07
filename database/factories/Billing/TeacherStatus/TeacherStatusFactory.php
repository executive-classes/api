<?php

namespace Database\Factories\Billing\TeacherStatus;

use App\Enums\Billing\TeacherStatusEnum;
use App\Models\Eloquent\Billing\TeacherStatus\TeacherStatus;
use Database\Factories\Factory;

class TeacherStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TeacherStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => TeacherStatusEnum::getRandomValue()
        ];
    }
}
