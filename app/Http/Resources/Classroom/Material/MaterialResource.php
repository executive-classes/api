<?php

namespace App\Http\Resources\Classroom\Material;

use App\Http\Resources\General\Category\CategoryResource;
use App\Http\Resources\Resource;

class MaterialResource extends Resource
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
            'title' => $this->title,
            'content' => $this->content,
            'style' => $this->style,
            'active' => $this->active,
            'category' => new CategoryResource($this->category)
        ];
    }
}
