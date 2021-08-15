<?php

namespace Database\Factories\General;

use App\Enums\General\CategoryTypeEnum;
use App\Models\General\Category;
use Database\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(15),
            'description' => $this->faker->text,
            'category_type_id' => CategoryTypeEnum::getRandomValue()
        ];
    }
}
