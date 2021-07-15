<?php

namespace App\Http\Resources\Billling\StudentStatus;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StudentStatusCollection extends ResourceCollection
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