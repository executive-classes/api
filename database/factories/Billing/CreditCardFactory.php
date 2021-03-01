<?php

namespace Database\Factories\Billing;

use App\Models\Billing\CreditCard;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreditCardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CreditCard::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $creditFake = $this->faker->creditCardDetails;
        return [
            'type' => $creditFake['type'],
            'name' => $creditFake['name'],
            'number' => $creditFake['number'],
            'expiration_date' => $creditFake['expirationDate'],
            'security' => $this->faker->numberBetween(001,9999)
        ];
    }
}
