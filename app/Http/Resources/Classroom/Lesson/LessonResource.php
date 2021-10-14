<?php

namespace App\Http\Resources\Classroom\Lesson;

use App\Http\Resources\Resource;
use App\Http\Resources\Classroom\Course\CourseResource;
use App\Http\Resources\Classroom\Module\ModuleResource;
use App\Http\Resources\General\Category\CategoryResource;

class LessonResource extends Resource
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
            'module' => $this->module ? new ModuleResource($this->module) : $this->module,
            'name' => $this->name,
            'active' => $this->active,
            'category' => new CategoryResource($this->category)
        ];
    }
}
