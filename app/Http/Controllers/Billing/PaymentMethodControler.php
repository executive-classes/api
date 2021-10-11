<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Http\Resources\Billing\PaymentMethod\PaymentMethodCollection;
use App\Models\Eloquent\Billing\PaymentMethod\PaymentMethod;

class PaymentMethodControler extends Controller
{
    public function index()
    {
        return new PaymentMethodCollection(PaymentMethod::all());
    }
}