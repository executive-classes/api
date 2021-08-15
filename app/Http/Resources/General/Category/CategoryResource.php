<?php

namespace App\Http\Resources\General\Category;

use App\Http\Resources\General\CategoryType\CategoryTypeResource;
use App\Http\Resources\Resource;

class CategoryResource extends Resource
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
            'description' => $this->description,
            'type' => new CategoryTypeResource($this->type),
            'parent' => new CategoryResource($this->parent),
        ];
    }
}
