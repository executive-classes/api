<?php

namespace App\Http\Controllers\Billling;

use App\Http\Controllers\Controller;
use App\Http\Resources\Billling\PaymentMethod\PaymentMethodCollection;
use App\Models\Billing\PaymentMethod;

class PaymentMethodControler extends Controller
{
    public function index()
    {
        return new PaymentMethodCollection(PaymentMethod::all());
    }
}