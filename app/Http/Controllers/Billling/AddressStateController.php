<?php

namespace App\Http\Controllers\Billling;

use App\Http\Controllers\Controller;
use App\Http\Resources\Billling\AddressState\AddressStateCollection;
use App\Models\Billing\AddressState;

class AddressStateController extends Controller
{
    public function index()
    {
        return new AddressStateCollection(AddressState::all());
    }
}