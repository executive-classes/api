<?php

namespace App\Http\Requests\Classroom\Lesson;

use App\Http\Requests\Request;

class UpdateLessonRequest extends Request
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
            'name'        => 'sometimes|min:3',
            'category_id' => 'sometimes|numeric|exists:category,id'
        ];
    }
}