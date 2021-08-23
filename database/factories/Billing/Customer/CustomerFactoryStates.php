<?php

namespace Database\Factories\Billing\Customer;

use App\Enums\Billing\CustomerStatusEnum;
use App\Traits\Factories\Billing\TaxStates;

trait CustomerFactoryStates
{
    use TaxStates;
    
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
}