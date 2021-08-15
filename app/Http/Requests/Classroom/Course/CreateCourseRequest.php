<?php

namespace App\Http\Requests\Classroom\Course;

use Illuminate\Foundation\Http\FormRequest;

class CreateCourseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => 'required|min:3',
            'category_id' => 'required|numeric|exists:category,id'
        ];
    }
}