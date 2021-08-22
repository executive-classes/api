<?php

namespace App\Http\Resources\Billling\Tax;

use App\Http\Resources\Resource;

class TaxResource extends Resource
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
            'id' => $this->id ?? null,
            'name' => $this->name ?? null,
            'code' => $this->code ?? null,
            'priority' => $this->priority ?? null,
            'mask' => $this->pattern ?? null
        ];
    }
}
