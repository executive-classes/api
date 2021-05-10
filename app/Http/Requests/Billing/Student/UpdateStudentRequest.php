<?php

namespace App\Http\Requests\Billing\Student;

use App\Enums\Billing\StudentStatusEnum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => 'sometimes|numeric|exists:customer,id',
            'biller_id' => 'required_with:customer_id|numeric|exists:biller,id',
            'student_status_id' => [
                'sometimes', 
                'string', 
                Rule::in(StudentStatusEnum::getUpdatableValues()), 
                new EnumValue(StudentStatusEnum::class)
            ]
        ];
    }
}