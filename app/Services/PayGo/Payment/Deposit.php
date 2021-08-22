<?php

namespace App\Services\PayGo\Payment;

use App\Exceptions\PayGo\PayGoException;
use App\Models\Billing\Collection\Collection;
use App\Services\PayGo\Contracts\PaymentContract;

class Deposit implements PaymentContract
{
    private $collection;
    
    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    public function getData(): array
    {
        throw new PayGoException(__('paygo.fail.invalid_payment'), 400);
    }
}