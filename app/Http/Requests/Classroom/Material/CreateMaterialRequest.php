<?php

namespace App\Http\Requests\Classroom\Material;

use App\Http\Requests\Request;

class CreateMaterialRequest extends Request
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
            'title'       => 'required|string',
            'content'     => 'required|string',
            'style'       => 'sometimes|nullable|string',
            'category_id' => 'required|numeric|exists:category,id'
        ];
    }
}