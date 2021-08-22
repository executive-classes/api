<?php

namespace Database\Factories\Classroom\Question;

use App\Models\Classroom\Question\Question;
use App\Models\General\Category\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name' => $this->faker->text(15),
            'question' => $this->faker->text(30),
            'category_id' => Category::factory()
        ];
    }
}
