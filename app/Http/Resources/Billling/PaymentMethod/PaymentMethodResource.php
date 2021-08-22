<?php

namespace App\Http\Resources\Billling\PaymentMethod;

use App\Http\Resources\Resource;

class PaymentMethodResource extends Resource
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
            'name' => $this->name,
            'description' => $this->description,
            'invoice_code' => $this->invoice_code,
        ];
    }
}
