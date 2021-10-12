<?php

namespace App\Http\Controllers\Billing;

use App\Models\Api\ViaCep\ViaCepClient;
use App\Models\Eloquent\Billing\Address\AddressFilters;
use App\Http\Controllers\Controller;
use App\Http\Requests\Billing\Address\AddressRequest;
use App\Http\Resources\Billing\Address\AddressSearchResource;
use App\Http\Resources\Billing\Address\AddressCollection;
use App\Http\Resources\Billing\Address\AddressResource;
use App\Models\Eloquent\Billing\Address\Address;
use App\Services\Billing\Address\Contract\AddressMaker;

class AddressController extends Controller
{
    public function index(AddressFilters $filter)
    {
        return new AddressCollection(Address::filter($filter)->get());
    }

    public function store(AddressRequest $request, AddressMaker $addressMaker)
    {
        $address = $addressMaker->create($request->validated());
        return new AddressResource($address->refresh());
    }

    public function search(string $cep, ViaCepClient $client)
    {
        try {
            $response = $client->consult($cep);

            if ($response->content()->erro ?? false) {
                return api()->notFound(__('billing.address.fail.search', ['zip' => $cep]));
            }
        } catch (\Throwable $th) {
            return api()->notFound(__('billing.address.fail.search', ['zip' => $cep]));
        }
        
        return new AddressSearchResource($response->content());
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