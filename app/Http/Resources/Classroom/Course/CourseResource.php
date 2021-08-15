<?php

namespace App\Http\Resources\Classroom\Course;

use App\Http\Resources\General\Category\CategoryResource;
use App\Http\Resources\Resource;

class CourseResource extends Resource
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
