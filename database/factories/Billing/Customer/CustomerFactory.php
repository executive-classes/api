<?php

namespace Database\Factories\Billing\Customer;

use App\Enums\Billing\CustomerStatusEnum;
use App\Enums\Billing\TaxTypeEnum;
use App\Models\Billing\Address\Address;
use App\Models\Billing\Customer\Customer;
use App\Traits\Factories\HasMultipleTaxTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    use HasMultipleTaxTypes;

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

    /**
     * Indicate that the customer is active.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'customer_status_id' => CustomerStatusEnum::ACTIVE,
            ];
        });
    }

    /**
     * Indicate that the customer has a CNPJ.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function cnpj(bool $alt = false)
    {
        return $this->state(function (array $attributes) use ($alt) {
            return $this->getTaxTypeColumns(
                TaxTypeEnum::CNPJ,
                $this->faker->unique()->cnpj,
                $alt
            );
        });
    }

    /**
     * Indicate that the customer has a CPF.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function cpf(bool $alt = false)
    {
        return $this->state(function (array $attributes) use ($alt) {
            return $this->getTaxTypeColumns(
                TaxTypeEnum::CPF,
                $this->faker->unique()->cpf,
                $alt
            );
        });
    }

    /**
     * Indicate that the customer has a RG.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function rg(bool $alt = false)
    {
        return $this->state(function (array $attributes) use ($alt) {
            return $this->getTaxTypeColumns(
                TaxTypeEnum::RG,
                $this->faker->unique()->randomNumber(10),
                $alt
            );
        });
    }

    /**
     * Indicate that the customer has a IE.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function ie(bool $alt = false)
    {
        return $this->state(function (array $attributes) use ($alt) {
            return $this->getTaxTypeColumns(
                TaxTypeEnum::IE,
                $this->faker->unique()->randomNumber(10),
                $alt
            );
        });
    }
}

