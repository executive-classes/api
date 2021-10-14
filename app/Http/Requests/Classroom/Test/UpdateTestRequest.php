<?php

namespace App\Http\Requests\Classroom\Test;

use App\Http\Requests\Request;

class UpdateTestRequest extends Request
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