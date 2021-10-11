<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Http\Resources\Billing\AddressCountry\AddressCountryCollection;
use App\Models\Eloquent\Billing\AddressCountry\AddressCountry;

class AddressCountryController extends Controller
{
    public function index()
    {
        return new AddressCountryCollection(AddressCountry::where('active', true)->get());
    }
}