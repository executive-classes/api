<?php

namespace App\Http\Requests\Classroom\Lesson;

use App\Http\Requests\Request;

class CreateLessonRequest extends Request
{
    /**
     * Get the request rules.
     *
     * @return array
     */
    public function getRules(): array
    {
        return [
            'course_id'   => 'sometimes|nullable|numeric|exists:course,id',
            'module_id'   => 'sometimes|nullable|numeric|exists:module,id',
            'name'        => 'required|min:3',
            'category_id' => 'required|numeric|exists:category,id'
        ];
    }
}