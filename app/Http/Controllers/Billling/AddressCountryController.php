<?php

namespace App\Http\Controllers\Billling;

use App\Http\Controllers\Controller;
use App\Http\Resources\Billling\AddressCountry\AddressCountryCollection;
use App\Models\Billing\AddressCountry\AddressCountry;

class AddressCountryController extends Controller
{
    public function index()
    {
        return new AddressCountryCollection(AddressCountry::where('active', true)->get());
    }
}