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

    /**
     * Indicate that the customer is suspended.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function suspended()
    {
        return $this->state(function (array $attributes) {
            return [
                'customer_status_id' => CustomerStatusEnum::SUSPENDED,
            ];
        });
    }

    /**
     * Indicate that the customer is canceled.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function canceled()
    {
        return $this->state(function (array $attributes) {
            return [
                'customer_status_id' => CustomerStatusEnum::CANCELED,
            ];
        });
    }

    /**
     * Indicate that the customer is inactive.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function inactive()
    {
        return $this->state(function (array $attributes) {
            return [
                'customer_status_id' => CustomerStatusEnum::INACTIVE,
            ];
        });
    }
}