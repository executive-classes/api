<?php

namespace App\Http\Requests\Billing\Teacher;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\Billing\TeacherStatusEnum;

class UpdateTeacherRequest extends Request
{
    /**
     * Get the request rules.
     *
     * @return array
     */
    public function getRules(): array
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