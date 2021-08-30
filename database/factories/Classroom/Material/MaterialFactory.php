<?php

namespace Database\Factories\Classroom\Material;

use App\Models\Eloquent\Classroom\Material\Material;
use App\Models\Eloquent\General\Category\Category;
use Database\Factories\Factory;

class MaterialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Material::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(15),
            'title' => $this->faker->text(15),
            'content' => '<h3>Material test</h3>',
            'style' => 'h3 { color: red; }',
            'category_id' => $this->relation(Category::class)
        ];
    }
}
