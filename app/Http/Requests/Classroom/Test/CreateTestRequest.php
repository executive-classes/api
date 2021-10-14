<?php

namespace App\Http\Requests\Classroom\Test;

use App\Http\Requests\Request;

class CreateTestRequest extends Request
{
    /**
     * Get the request rules.
     *
     * @return array
     */
    public function getRules(): array
    {
        return [
            'name'        => 'required|min:3',
            'category_id' => 'required|numeric|exists:category,id'
        ];
    }
}