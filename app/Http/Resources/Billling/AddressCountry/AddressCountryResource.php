<?php

namespace App\Http\Resources\Billling\AddressCountry;

use App\Http\Resources\Resource;

class AddressCountryResource extends Resource
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
            'short_name' => $this->short_name,
            'name' => $this->name,
            'name_pt' => $this->name_pt
        ];
    }
}
