<?php

namespace Database\Factories\Billing;

use App\Models\Billing\Biller;
use App\Models\Billing\Student;
use App\Models\Billing\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $biller = $this->faker->randomElement(Biller::all());
        return [
            'customer_id' => $biller->customer_id,
            'biller_id' => $biller->id,
            'user_id' => $this->faker->unique()->randomElement(User::all())
        ];
    }
}
