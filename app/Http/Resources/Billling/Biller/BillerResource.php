<?php

namespace App\Http\Resources\Billling\Biller;

use Carbon\Carbon;
use App\Http\Resources\Resource;
use App\Traits\Resources\WithTaxes;
use App\Traits\Resources\WithPhones;
use App\Http\Resources\Billling\Address\AddressResource;
use App\Http\Resources\Billling\Customer\CustomerResource;
use App\Http\Resources\Billling\BillerStatus\BillerStatusResource;
use App\Http\Resources\Billling\PaymentMethod\PaymentMethodResource;
use App\Http\Resources\Billling\PaymentInterval\PaymentIntervalResource;

class BillerResource extends Resource
{
    use WithTaxes;
    use WithPhones;

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
            'status' => new BillerStatusResource($this->status),
            'interval' => new PaymentIntervalResource($this->interval),
            'payment_method' => new PaymentMethodResource($this->paymentMethod),
            'customer' => new CustomerResource($this->customer),
            'address' => new AddressResource($this->address),
        ];
    }
}
