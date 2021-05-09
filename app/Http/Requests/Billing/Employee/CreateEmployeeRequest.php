<?php

namespace App\Http\Requests\Billing\Employee;

use App\Enums\Billing\EmployeePositionEnum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|numeric|exists:user,id',
            'employee_position_id' => ['required', 'string', new EnumValue(EmployeePositionEnum::class)]
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            
        ];
    }
}