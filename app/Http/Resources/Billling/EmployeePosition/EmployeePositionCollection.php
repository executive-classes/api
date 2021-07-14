<?php

namespace App\Http\Resources\Billling\EmployeePosition;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployeePositionCollection extends ResourceCollection
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