<?php

namespace Database\Factories\General\CategoryType;

use App\Enums\General\CategoryTypeEnum;
use App\Models\Eloquent\General\CategoryType\CategoryType;
use Database\Factories\Factory;

class CategoryTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoryType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => CategoryTypeEnum::getRandomValue()
        ];
    }
}
