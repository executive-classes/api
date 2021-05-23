<?php

namespace App\Http\Requests\System;

use Illuminate\Foundation\Http\FormRequest;

class GetBugLogRequest extends FormRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'limit' => 'sometimes|numeric|max:1000',
            'paginate' => 'sometimes|numeric|min:5|max:100'
        ];
    }
}