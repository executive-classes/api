<?php

namespace App\Http\Resources\Billling\Tax;

use App\Http\Resources\Resource;

class TaxTypeResource extends Resource
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
            'priority' => $this->priority,
            'mask' => $this->pattern
        ];
    }
}
