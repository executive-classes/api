<?php

namespace App\Http\Resources\Billing\CustomerStatus;

use App\Enums\Billing\CustomerStatusEnum;
use App\Http\Resources\EnumResource;

class CustomerStatusResource extends EnumResource
{
    /**
     * The Enum class.
     * 
     * @var \App\Enums\Enum
     */
    public $enum = CustomerStatusEnum::class;

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
        ];
    }
}
