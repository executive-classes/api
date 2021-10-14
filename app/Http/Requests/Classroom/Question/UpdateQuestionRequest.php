<?php

namespace App\Http\Requests\Classroom\Question;

use App\Http\Requests\Request;

class UpdateQuestionRequest extends Request
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
            'question'    => 'sometimes|string',
            'category_id' => 'sometimes|numeric|exists:category,id'
        ];
    }
}