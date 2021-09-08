<?php

namespace Database\Factories\Classroom\Question;

use App\Models\Eloquent\Classroom\Question\Question;
use App\Models\Eloquent\General\Category\Category;
use Database\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

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
            'question' => $this->faker->text(30),
            'category_id' => $this->relation(Category::class)
        ];
    }
}
