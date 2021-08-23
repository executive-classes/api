<?php

namespace App\Http\Requests\Billing\Employee;

use App\Enums\Billing\EmployeePositionEnum;
use App\Http\Requests\Request;
use BenSampo\Enum\Rules\EnumValue;

class CreateEmployeeRequest extends Request
{
    /**
     * Get the request rules.
     *
     * @return array
     */
    public function getRules(): array
    {
        return [
            'user_id'              => 'required|numeric|exists:user,id',
            'employee_position_id' => ['required', 'string', new EnumValue(EmployeePositionEnum::class)]
        ];
    }
}