<?php

namespace App\Http\Resources\Billing\Tax;

use App\Enums\Billing\TaxTypeEnum;
use App\Http\Resources\EnumResource;

class TaxTypeResource extends EnumResource
{
    /**
     * The Enum class.
     * 
     * @var \App\Enums\Enum
     */
    public $enum = TaxTypeEnum::class;
    
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
            'priority' => $this->priority,
            'mask' => $this->pattern
        ];
    }
}
