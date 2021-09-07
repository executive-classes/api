<?php

namespace Database\Factories\Classroom\LessonStatus;

use Database\Factories\Factory;
use App\Enums\Classroom\LessonStatusEnum;
use App\Models\Eloquent\Classroom\LessonStatus\LessonStatus;

class LessonStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LessonStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => LessonStatusEnum::getRandomValue()
        ];
    }
}