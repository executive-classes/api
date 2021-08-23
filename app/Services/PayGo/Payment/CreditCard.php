<?php

namespace App\Services\PayGo\Payment;

use App\Models\Eloquent\Billing\Collection\Collection;
use App\Services\PayGo\Contracts\PaymentContract;

class CreditCard implements PaymentContract
{
    private $collection;
    
    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    public function getData(): array
    {
        $data = config('api.paygo.credit_card') + [
            "installments" => $this->collection->payment_interval_id,
            "softDescriptor" => $this->collection->truncatedDescription,
            "cardInfo" => [
                "token" => $this->collection->token_id
            ]
        ];

        return ['card' => $data];
    }
}