<?php

namespace App\Http\Resources\Billling\PaymentInterval;

use App\Http\Resources\EnumResource;
use App\Enums\Billing\PaymentIntervalEnum;

class PaymentIntervalResource extends EnumResource
{
    /**
     * The Enum class.
     * 
     * @var \App\Enums\Enum
     */
    public $enum = PaymentIntervalEnum::class;

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
            'description' => $this->description
        ];
    }
}
