<?php

namespace App\Http\Requests\Classroom\Module;

use App\Http\Requests\Request;

class CreateModuleRequest extends Request
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
            'name'        => 'required|min:3',
            'category_id' => 'required|numeric|exists:category,id'
        ];
    }
}