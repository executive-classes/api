<?php

namespace App\Http\Requests\Classroom\Course;

use App\Http\Requests\Request;

class UpdateCourseRequest extends Request
{
    /**
     * Get the request rules.
     *
     * @return array
     */
    public function getRules(): array
    {
        return [
            'name'        => 'sometimes|min:3',
            'category_id' => 'sometimes|numeric|exists:category,id'
        ];
    }
}