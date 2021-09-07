<?php

namespace Database\Factories\Classroom\TestStatus;

use Database\Factories\Factory;
use App\Enums\Classroom\TestStatusEnum;
use App\Models\Eloquent\Classroom\TestStatus\TestStatus;

class TestStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TestStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => TestStatusEnum::getRandomValue()
        ];
    }
}