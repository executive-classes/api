<?php

namespace App\Http\Requests\Billing\Employee;

use App\Enums\Billing\EmployeePositionEnum;
use App\Enums\Billing\EmployeeStatusEnum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'employee_status_id' => [
                'sometimes', 
                'string', 
                Rule::in(EmployeeStatusEnum::getUpdatableValues()), 
                new EnumValue(EmployeeStatusEnum::class)
            ],
            'employee_position_id' => [
                'sometimes', 
                'string', 
                new EnumValue(EmployeePositionEnum::class)
            ]
        ];
    }
}