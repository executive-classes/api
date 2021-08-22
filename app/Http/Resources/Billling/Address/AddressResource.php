<?php

namespace App\Http\Resources\Billling\Address;

use App\Http\Resources\Billling\AddressCountry\AddressCountryResource;
use App\Http\Resources\Resource;

class AddressResource extends Resource
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
            'id' => $this->id,
            'zip' => format_zip($this->zip),
            'street' => $this->street,
            'number' => $this->number,
            'complement' => $this->complement,
            'district' => $this->district,
            'city' => $this->city,
            'state' => $this->state,
            'country' => new AddressCountryResource($this->countryModel)
        ];
    }
}
