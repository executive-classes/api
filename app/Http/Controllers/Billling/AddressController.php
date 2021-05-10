<?php

namespace App\Http\Controllers\Billling;

use App\Filters\Billing\AddressFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Billing\Address\AddressRequest;
use App\Http\Resources\Billling\AddressCollection;
use App\Http\Resources\Billling\AddressResource;
use App\Models\Billing\Address;
use App\Services\Billing\Address\Contract\AddressMaker;

class AddressController extends Controller
{
    public function index(AddressFilter $filter)
    {
        return new AddressCollection(Address::filter($filter)->get());
    }

    public function store(AddressRequest $request, AddressMaker $addressMaker)
    {
        $address = $addressMaker->create($request->validated());
        return new AddressResource($address->refresh());
    }

    public function show(Address $address)
    {
        return new AddressResource($address);
    }

    public function update(AddressRequest $request, Address $address, AddressMaker $addressMaker)
    {
        $address = $addressMaker->update($request->validated(), $address);
        return new AddressResource($address->refresh());
    }

    public function destroy(Address $address)
    {
        $address->delete();
        return api()->noContent();
    }
}