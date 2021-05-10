<?php

namespace App\Http\Requests\Billing\Student;

use Illuminate\Foundation\Http\FormRequest;

class CreateStudentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => 'required|numeric|exists:customer,id',
            'biller_id' => 'required|numeric|exists:biller,id',
            'user_id' => 'required|numeric|exists:user,id',
        ];
    }
}