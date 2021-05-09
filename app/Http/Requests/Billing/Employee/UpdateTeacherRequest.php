<?php

namespace App\Http\Requests\Billing\Employee;

use App\Enums\Billing\TeacherStatusEnum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeacherRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'teacher_status_id' => [
                'sometimes', 
                'string', 
                Rule::in(TeacherStatusEnum::getUpdatableValues()), 
                new EnumValue(TeacherStatusEnum::class)
            ]
        ];
    }
}