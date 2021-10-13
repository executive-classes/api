<?php

namespace Database\Factories\Billing\Student;

use App\Enums\Billing\StudentStatusEnum;
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
        $biller = $this->relation(Biller::class);
        return [
            'id' => $this->id(),
            'biller_id' => $this->relation(Biller::class),
            'customer_id' => $biller->customer_id,
            'user_id' => $this->relation(User::class),
            'student_status_id' => $this->faker->randomElement(StudentStatusEnum::getUpdatableValues())
        ];
    }
}
