<?php

namespace App\Services\PayGo\Payment;

use App\Models\Eloquent\Billing\Collection\Collection;
use App\Services\PayGo\Contracts\PaymentContract;
use Carbon\Carbon;

class BankSlip implements PaymentContract
{
    private $collection;
    
    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    public function getData(): array
    {
        $data = config('api.paygo.bank_slip') + [
            "expirationDate" => Carbon::create($this->collection->expire_at)->toDateString()
        ];

        return ['bankSlip' => $data];
    }
}