<?php

namespace App\Http\Controllers\Billling;

use App\Http\Controllers\Controller;
use App\Http\Resources\Billling\AddressState\AddressStateCollection;
use App\Models\Eloquent\Billing\AddressState\AddressState;

class AddressStateController extends Controller
{
    public function index()
    {
        return new AddressStateCollection(AddressState::all());
    }
}