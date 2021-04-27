<?php

namespace App\Traits\Models\Billing;

use App\Services\PayGo\Contracts\PaymentContract;

trait HasPayGo
{
    public function getAmount(): int
    {
        return round($this->amount * 100);
    }

    public function getPayGoPayment(): PaymentContract
    {
        $paymentsNamespace = 'App\\Services\\PayGo\\Payment\\';
        $className = $paymentsNamespace . underlineToCamelCase($this->payment_method_id);
        return new $className($this);
    }
}