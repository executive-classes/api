<?php

namespace App\Http\Resources\Billling;

use Illuminate\Http\Resources\Json\JsonResource;

class BillerResource extends JsonResource
{
    /**
     * The additional meta data that should be added to the resource response.
     *
     * Added during response construction by the developer.
     *
     * @var array
     */
    public $additional = [
        'status' => true
    ];

    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'data';

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
            'name' => $this->name,
            'tax_type' => $this->tax_type_id,
            'tax_code' => $this->tax_code,
            'tax_type_alt' => $this->tax_type_alt_id,
            'tax_code_alt' => $this->tax_code_alt,
            'email' => $this->email,
            'phone' => $this->phone,
            'phone_alt' => $this->phone_alt,
            'status' => $this->status->name,
            'status_id' => $this->biller_status_id,
            'interval' => $this->payment_interval_id,
            'payment_method' => $this->payment_method_id,
            'customer' => new CustomerResource($this->customer),
            'address' => new AddressResource($this->address),
        ];
    }
}
