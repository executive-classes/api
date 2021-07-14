<?php

namespace App\Http\Resources\Billling\EmployeePosition;

use App\Http\Resources\Resource;

class EmployeePositionResource extends Resource
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
            'parent' => $this->parent,
            'children' => $this->children
        ];
    }
}
