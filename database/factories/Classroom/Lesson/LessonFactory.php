<?php

namespace Database\Factories\Classroom\Lesson;

use App\Models\Eloquent\Classroom\Lesson\Lesson;
use App\Models\Eloquent\General\Category\Category;
use Database\Factories\Factory;

class LessonFactory extends Factory
{
    use LessonFactoryStates;
    
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lesson::class;

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
