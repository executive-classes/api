<?php

namespace Database\Factories\Billing\Biller;

use App\Enums\Billing\TaxTypeEnum;
use App\Models\Eloquent\Billing\Biller\Biller;
use App\Models\Eloquent\Billing\Address\Address;
use App\Models\Eloquent\Billing\Customer\Customer;
use App\Models\Eloquent\Billing\PaymentInterval\PaymentInterval;
use App\Models\Eloquent\Billing\PaymentMethod\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'customer_id' => Customer::factory(),
            'name' => $this->faker->company,
            'tax_type_id' => TaxTypeEnum::CNPJ,
            'tax_code' => $this->faker->cnpj,
            'address_id' => Address::factory(),
            'email' => $this->faker->companyEmail,
            'phone' => $this->faker->phoneNumber,
            'phone_alt' => $this->faker->phoneNumber,
            'payment_interval_id' => PaymentInterval::inRandomOrder()->first(),
            'payment_method_id' => PaymentMethod::inRandomOrder()->first()
        ];
    }
}
