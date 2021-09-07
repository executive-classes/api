<?php

namespace Database\Factories\Billing\StudentStatus;

use App\Enums\Billing\StudentStatusEnum;
use App\Models\Eloquent\Billing\StudentStatus\StudentStatus;
use Database\Factories\Factory;

class StudentStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StudentStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => StudentStatusEnum::getRandomValue()
        ];
    }
}
