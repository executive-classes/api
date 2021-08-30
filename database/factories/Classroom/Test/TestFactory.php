<?php

namespace Database\Factories\Classroom\Test;

use App\Models\Eloquent\Classroom\Test\Test;
use App\Models\Eloquent\General\Category\Category;
use Database\Factories\Factory;

class TestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Test::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(15),
            'category_id' => $this->relation(Category::class)
        ];
    }
}
