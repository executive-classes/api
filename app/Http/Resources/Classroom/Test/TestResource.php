<?php

namespace App\Http\Resources\Classroom\Test;

use App\Http\Resources\Resource;
use App\Http\Resources\General\Category\CategoryResource;

class TestResource extends Resource
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
            'name' => $this->name,
            'active' => $this->active,
            'category' => new CategoryResource($this->category)
        ];
    }
}
