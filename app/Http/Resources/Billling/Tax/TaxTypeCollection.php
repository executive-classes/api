<?php

namespace App\Http\Resources\Billling\Tax;

use App\Http\Resources\ResourceCollection;

class TaxTypeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'status' => true,
            'data' => $this->collection,
            'primary' => $this->collection->filter(function ($taxType) {
                return $taxType->priority === 1;
            })->toArray(),
            'secondary' => $this->collection->filter(function ($taxType) {
                return $taxType->priority === 2;
            })->toArray()
        ];
    }
}
