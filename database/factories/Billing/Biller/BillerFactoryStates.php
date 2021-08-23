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
}