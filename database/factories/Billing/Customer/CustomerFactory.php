<?php

namespace Database\Factories\Billing\Customer;

use App\Enums\Billing\TaxTypeEnum;
use App\Models\Eloquent\Billing\Address\Address;
use App\Models\Eloquent\Billing\Customer\Customer;
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
            'name' => $this->faker->company,
            'tax_type_id' => TaxTypeEnum::CNPJ,
            'tax_code' => $this->faker->unique()->cnpj,
            'address_id' => Address::factory(),
            'email' => $this->faker->companyEmail,
            'phone' => $this->faker->phoneNumber,
            'phone_alt' => $this->faker->phoneNumber,
        ];
    }
}

