<?php

namespace Database\Factories\Billing;

use App\Models\Billing\Bank;
use Illuminate\Database\Eloquent\Factories\Factory;

class BankFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bank::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bank_code' => $this->faker->numberBetween(0,299),
            'agency' => $this->faker->numberBetween(0001, 9999),
            'account' => $this->faker->numberBetween(1, 9999999999)
        ];
    }
}
