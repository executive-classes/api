<?php

namespace Database\Factories\General\Category;

use App\Enums\General\CategoryTypeEnum;
use App\Models\Eloquent\General\Category\Category;
use Database\Factories\Factory;

class CategoryFactory extends Factory
{
    use CategoryFactoryStates;
    
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
            'id' => $this->id(),
            'name' => $this->faker->text(15),
            'description' => $this->faker->text,
            'category_type_id' => CategoryTypeEnum::getRandomValue()
        ];
    }
}
