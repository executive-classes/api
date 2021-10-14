<?php

namespace App\Http\Resources\Classroom\Module;

use App\Http\Resources\Resource;
use App\Http\Resources\Classroom\Course\CourseResource;
use App\Http\Resources\General\Category\CategoryResource;

class ModuleResource extends Resource
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
            'course' => $this->course ? new CourseResource($this->course) : $this->course,
            'name' => $this->name,
            'active' => $this->active,
            'category' => new CategoryResource($this->category)
        ];
    }
}
