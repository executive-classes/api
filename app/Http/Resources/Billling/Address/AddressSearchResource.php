<?php

namespace App\Http\Resources\Billling\Address;

use App\Enums\Billing\CountryEnum;
use App\Http\Resources\Billling\AddressCountry\AddressCountryResource;
use App\Http\Resources\Resource;
use App\Models\Eloquent\Billing\AddressCountry\AddressCountry;

class AddressSearchResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => null,
            'zip' => $this->cep,
            'street' => $this->logradouro,
            'number' => null,
            'complement' => null,
            'district' => $this->bairro,
            'city' => $this->localidade,
            'state' => $this->uf,
            'country' => new AddressCountryResource($this->getCountry()),
        ];
    }

    public function getCountry()
    {
        return AddressCountry::where('short_name', CountryEnum::BR)->first();
    }
}
