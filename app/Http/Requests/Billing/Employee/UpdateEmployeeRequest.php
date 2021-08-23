<?php

namespace App\Http\Requests\Billing\Employee;

use App\Enums\Billing\EmployeePositionEnum;
use App\Enums\Billing\EmployeeStatusEnum;
use App\Http\Requests\Request;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends Request
{
    /**
     * Get the request rules.
     *
     * @return array
     */
    public function getRules(): array
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