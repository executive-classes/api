<?php

namespace App\Http\Resources\Billling\BillerStatus;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BillerStatusCollection extends ResourceCollection
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
            'data' => $this->collection
        ];
    }
}