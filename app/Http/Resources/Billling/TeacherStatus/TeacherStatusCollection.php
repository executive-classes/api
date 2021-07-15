<?php

namespace App\Http\Resources\Billling\TeacherStatus;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TeacherStatusCollection extends ResourceCollection
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