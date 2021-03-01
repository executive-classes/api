<?php

namespace Database\Factories\Billing;

use App\Models\Billing\Biller;
use App\Models\Billing\BillerStatus;
use App\Models\Billing\TaxType;
use Illuminate\Database\Eloquent\Factories\Factory;

class BillerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Biller::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'biller_status_id' => BillerStatus::ACTIVE,
            'name' => $this->faker->company,
            'tax_type_id' => TaxType::CNPJ,
            'tax_code' => $this->faker->cnpj,
            'email' => $this->faker->companyEmail,
            'phone' => $this->faker->phoneNumber,
            'phone_alt' => $this->faker->phoneNumber
        ];
    }
}
