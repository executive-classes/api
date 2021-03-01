<?php

namespace Database\Factories\Billing;

use App\Models\Billing\Teacher;
use App\Models\Billing\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Teacher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->unique()->randomElement(User::all())
        ];
    }
}
