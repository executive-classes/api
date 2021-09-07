<?php

namespace Database\Factories\Classroom\ModuleStatus;

use Database\Factories\Factory;
use App\Enums\Classroom\ModuleStatusEnum;
use App\Models\Eloquent\Classroom\ModuleStatus\ModuleStatus;

class ModuleStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ModuleStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => ModuleStatusEnum::getRandomValue()
        ];
    }
}