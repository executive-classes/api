<?php

namespace App\Services\PayGo\Contracts;

use App\Models\Eloquent\Billing\Collection\Collection;

interface PaymentContract
{
    public function __construct(Collection $collection);
    public function getData(): array;
}