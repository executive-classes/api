<?php

namespace Database\Factories\General;

use App\Models\General\Category;
use App\Models\General\CategoryType;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'category_type_id' => CategoryType::inRandomOrder()->first()
        ];
    }
}
