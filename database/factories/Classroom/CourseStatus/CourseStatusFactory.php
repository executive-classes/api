<?php

namespace Database\Factories\Classroom\CourseStatus;

use Database\Factories\Factory;
use App\Enums\Classroom\CourseStatusEnum;
use App\Models\Eloquent\Classroom\CourseStatus\CourseStatus;

class CourseStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CourseStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => CourseStatusEnum::getRandomValue()
        ];
    }
}