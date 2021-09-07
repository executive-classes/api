<?php

namespace Database\Factories\Classroom\QuestionStatus;

use Database\Factories\Factory;
use App\Enums\Classroom\QuestionStatusEnum;
use App\Models\Eloquent\Classroom\QuestionStatus\QuestionStatus;

class QuestionStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuestionStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => QuestionStatusEnum::getRandomValue()
        ];
    }
}