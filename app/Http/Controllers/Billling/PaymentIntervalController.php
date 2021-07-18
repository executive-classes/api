<?php

namespace App\Http\Controllers\Billling;

use App\Http\Controllers\Controller;
use App\Http\Resources\Billling\PaymentInterval\PaymentIntervalCollection;
use App\Models\Billing\PaymentInterval;

class PaymentIntervalController extends Controller
{
    public function index()
    {
        return new PaymentIntervalCollection(PaymentInterval::all());
    }
}
