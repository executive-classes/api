<?php

namespace Database\Factories\Billing\Biller;

use App\Enums\Billing\BillerStatusEnum;
use App\Traits\Factories\Billing\PaymentIntervalStates;
use App\Traits\Factories\Billing\PaymentMethodStates;
use App\Traits\Factories\Billing\TaxStates;

trait BillerFactoryStates
{
    use TaxStates;
    use PaymentMethodStates;
    use PaymentIntervalStates;

    /**
     * Indicate that the biller is active.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'biller_status_id' => BillerStatusEnum::ACTIVE,
            ];
        });
    }

    /**
     * Indicate that the biller is suspended.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function suspended()
    {
        return $this->state(function (array $attributes) {
            return [
                'biller_status_id' => BillerStatusEnum::SUSPENDED,
            ];
        });
    }

    /**
     * Indicate that the biller is canceled.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function canceled()
    {
        return $this->state(function (array $attributes) {
            return [
                'biller_status_id' => BillerStatusEnum::CANCELED,
            ];
        });
    }

    /**
     * Indicate that the biller is inactive.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function inactive()
    {
        return $this->state(function (array $attributes) {
            return [
                'biller_status_id' => BillerStatusEnum::INACTIVE,
            ];
        });
    }
}