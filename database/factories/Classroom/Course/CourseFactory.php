<?php

namespace Database\Factories\Classroom\Course;

use App\Models\Classroom\Course\Course;
use App\Models\General\Category\Category;
use Database\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(15),
            'active' => true,
            'category_id' => $this->relation(Category::class)
        ];
    }
}
