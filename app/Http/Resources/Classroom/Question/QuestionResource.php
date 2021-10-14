<?php

namespace App\Http\Resources\Classroom\Question;

use App\Http\Resources\General\Category\CategoryResource;
use App\Http\Resources\Resource;

class QuestionResource extends Resource
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
            'question' => $this->question,
            'active' => $this->active,
            'category' => new CategoryResource($this->category)
        ];
    }
}
