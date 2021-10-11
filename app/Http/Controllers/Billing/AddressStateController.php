<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Http\Resources\Billing\AddressState\AddressStateCollection;
use App\Models\Eloquent\Billing\AddressState\AddressState;

class AddressStateController extends Controller
{
    public function index()
    {
        return new AddressStateCollection(AddressState::all());
    }
}