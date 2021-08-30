<?php

namespace Database\Factories\Billing\Student;

use App\Models\Eloquent\Billing\User\User;
use App\Models\Eloquent\Billing\Biller\Biller;
use App\Models\Eloquent\Billing\Student\Student;
use Database\Factories\Billing\Student\StudentFactoryStates;
use Database\Factories\Factory;

class StudentFactory extends Factory
{
    use StudentFactoryStates;

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
        return [
            'biller_id' => $this->relation(Biller::class),
            'customer_id' => function (array $attributes) {
                return Biller::find($attributes['biller_id'])->customer_id;
            },
            'user_id' => $this->relation(User::class)
        ];
    }
}
