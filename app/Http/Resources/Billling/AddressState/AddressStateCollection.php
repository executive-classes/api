<?php

namespace App\Http\Resources\Billling\AddressState;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AddressStateCollection extends ResourceCollection
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
            'data' => $this->collection->sortBy('short_name')->toArray()
        ];
    }
}
