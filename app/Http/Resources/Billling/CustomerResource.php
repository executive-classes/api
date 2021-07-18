<?php

namespace App\Http\Resources\Billling;

use App\Http\Resources\Billling\Address\AddressResource;
use App\Http\Resources\Billling\CustomerStatus\CustomerStatusResource;
use App\Http\Resources\Resource;
use App\Traits\Resources\WithPhones;
use App\Traits\Resources\WithTaxes;
use Carbon\Carbon;

class CustomerResource extends Resource
{
    use WithTaxes, WithPhones;

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
            'created_at' => Carbon::parse($this->created_at)->toDateTimeString(),
            'updated_at' => Carbon::parse($this->updated_at)->toDateTimeString(),
            'inactive_at' => $this->inactive_at ? Carbon::parse($this->inactive_at)->toDateTimeString() : null,
            'reactive_at' => $this->reactive_at ? Carbon::parse($this->reactive_at)->toDateTimeString() : null,
            'name' => $this->name,
            'tax' => $this->makeTax($this->taxType, $this->tax_code),
            'tax_alt' => $this->makeTax($this->taxTypeAlt, $this->tax_code_alt),
            'email' => $this->email,
            'phone' => $this->makePhone($this->phone),
            'phone_alt' => $this->makePhone($this->phone_alt),
            'status' => new CustomerStatusResource($this->status),
            'address' => new AddressResource($this->address)
        ];
    }
}
