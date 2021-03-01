<?php

namespace Database\Factories\Billing;

use App\Models\Billing\Biller;
use App\Models\Billing\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Collection::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $biller = $this->faker->randomElement(Biller::all());
        return [
            'biller_id' => $biller->id,
            'value' => $this->faker->randomFloat(2, 0, 10000),
            'payment_interval_id' => $biller->payment_interval_id,
            'payment_method_id' => $biller->payment_method_id,
            'credit_card_id' => $biller->credit_card_id,
            'bank_id' => $biller->bank_id,
        ];
    }
}
