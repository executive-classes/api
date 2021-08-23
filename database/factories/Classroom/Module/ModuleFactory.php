<?php

namespace Database\Factories\Classroom\Module;

use App\Models\Eloquent\Classroom\Module\Module;
use App\Models\Eloquent\General\Category\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Module::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(15),
            'category_id' => Category::factory()
        ];
    }
}
