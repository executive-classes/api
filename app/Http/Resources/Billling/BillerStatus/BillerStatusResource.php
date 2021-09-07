<?php

namespace App\Http\Resources\Billling\BillerStatus;

use App\Enums\Billing\BillerStatusEnum;
use App\Http\Resources\EnumResource;

class BillerStatusResource extends EnumResource
{
    /**
     * The Enum class.
     * 
     * @var \App\Enums\Enum
     */
    public $enum = BillerStatusEnum::class;

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
