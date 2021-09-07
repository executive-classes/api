<?php

namespace Database\Factories\Classroom\MaterialStatus;

use Database\Factories\Factory;
use App\Enums\Classroom\MaterialStatusEnum;
use App\Models\Eloquent\Classroom\MaterialStatus\MaterialStatus;

class MaterialStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MaterialStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => MaterialStatusEnum::getRandomValue()
        ];
    }
}