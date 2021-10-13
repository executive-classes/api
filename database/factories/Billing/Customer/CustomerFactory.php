<?php

namespace Database\Factories\Billing\Customer;

use App\Enums\Billing\CustomerStatusEnum;
use App\Enums\Billing\TaxTypeEnum;
use App\Models\Eloquent\Billing\Address\Address;
use App\Models\Eloquent\Billing\Customer\Customer;
use App\Models\Eloquent\Billing\CustomerStatus\CustomerStatus;
use Database\Factories\Factory;

class CustomerFactory extends Factory
{
    use CustomerFactoryStates;
    
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
            'id' => $this->id(),
            'customer_status_id' => $this->faker->randomElement(CustomerStatusEnum::getUpdatableValues()),
            'name' => $this->faker->company,
            'tax_type_id' => TaxTypeEnum::CNPJ,
            'tax_code' => $this->faker->unique()->cnpj,
            'address_id' => $this->relation(Address::class),
        ];
    }
}

