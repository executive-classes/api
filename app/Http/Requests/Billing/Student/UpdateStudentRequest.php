<?php

namespace App\Http\Requests\Billing\Student;

use App\Enums\Billing\StudentStatusEnum;
use App\Http\Requests\Request;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends Request
{
    /**
     * Get the request rules.
     *
     * @return array
     */
    public function getRules(): array
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