<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection as MainResourceCollection;

class ResourceCollection extends MainResourceCollection
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
        ];
    }
}
