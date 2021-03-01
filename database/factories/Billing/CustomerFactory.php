<?php

namespace Database\Factories\Billing;

use App\Models\Billing\Customer;
use App\Models\Billing\CustomerStatus;
use App\Models\Billing\TaxType;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_status_id' => CustomerStatus::ACTIVE,
            'name' => $this->faker->company,
            'tax_type_id' => TaxType::CNPJ,
            'tax_code' => $this->faker->cnpj,
            'email' => $this->faker->companyEmail,
            'phone' => $this->faker->phoneNumber,
            'phone_alt' => $this->faker->phoneNumber
        ];
    }
}

