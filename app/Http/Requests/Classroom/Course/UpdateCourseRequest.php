<?php

namespace App\Http\Requests\Classroom\Course;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => 'sometimes|min:3',
            'category_id' => 'sometimes|numeric|exists:category,id'
        ];
    }
}