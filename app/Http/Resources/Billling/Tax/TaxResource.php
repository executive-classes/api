<?php

namespace App\Http\Resources\Billling\Tax;

use App\Enums\Billing\TaxTypeEnum;
use App\Http\Resources\EnumResource;

class TaxResource extends EnumResource
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
            'id' => $this->id ?? null,
            'name' => $this->name ?? null,
            'code' => $this->code ?? null,
            'priority' => $this->priority ?? null,
            'mask' => $this->pattern ?? null
        ];
    }
}
