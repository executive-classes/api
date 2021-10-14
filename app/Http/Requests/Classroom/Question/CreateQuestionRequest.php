<?php

namespace App\Http\Requests\Classroom\Question;

use App\Http\Requests\Request;

class CreateQuestionRequest extends Request
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
            'question'    => 'required|string',
            'category_id' => 'required|numeric|exists:category,id'
        ];
    }
}