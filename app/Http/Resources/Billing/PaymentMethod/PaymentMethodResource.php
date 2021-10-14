<?php

namespace App\Http\Resources\Billing\PaymentMethod;

use App\Http\Resources\EnumResource;
use App\Enums\Billing\PaymentMethodEnum;

class PaymentMethodResource extends EnumResource
{
    /**
     * The Enum class.
     * 
     * @var \App\Enums\Enum
     */
    public $enum = PaymentMethodEnum::class;

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