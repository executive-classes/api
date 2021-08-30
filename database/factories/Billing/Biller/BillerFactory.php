<?php

namespace Database\Factories\Billing\Biller;

use App\Enums\Billing\PaymentIntervalEnum;
use App\Enums\Billing\PaymentMethodEnum;
use App\Enums\Billing\TaxTypeEnum;
use App\Models\Eloquent\Billing\Biller\Biller;
use App\Models\Eloquent\Billing\Address\Address;
use App\Models\Eloquent\Billing\Customer\Customer;
use Database\Factories\Factory;

class BillerFactory extends Factory
{
    use BillerFactoryStates;

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
            'customer_id' => $this->relation(Customer::class),
            'name' => $this->faker->company,
            'tax_type_id' => TaxTypeEnum::CNPJ,
            'tax_code' => $this->faker->cnpj,
            'address_id' => $this->relation(Address::class),
            'email' => $this->faker->companyEmail,
            'phone' => $this->faker->phoneNumber,
            'phone_alt' => $this->faker->phoneNumber,
            'payment_interval_id' => PaymentIntervalEnum::getRandomValue(),
            'payment_method_id' => PaymentMethodEnum::getRandomValue()
        ];
    }
}
