<?php

namespace App\Http\Requests\Classroom\Material;

use App\Http\Requests\Request;

class UpdateMaterialRequest extends Request
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
            'title'       => 'sometimes|string',
            'content'     => 'sometimes|string',
            'style'       => 'sometimes|nullable|string',
            'category_id' => 'sometimes|numeric|exists:category,id'
        ];
    }
}