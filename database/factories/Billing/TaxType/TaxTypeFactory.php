<?php

namespace Database\Factories\Billing\TaxType;

use App\Enums\Billing\TaxTypeEnum;
use App\Models\Eloquent\Billing\TaxType\TaxType;
use Database\Factories\Factory;

class TaxTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TaxType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => TaxTypeEnum::getRandomValue(),
            'priority' => $this->faker->numberBetween(1, 2)
        ];
    }
}