<?php

namespace App\Http\Requests\Billing\Teacher;

use App\Http\Requests\Request;

class CreateTeacherRequest extends Request
{
    /**
     * Get the request rules.
     *
     * @return array
     */
    public function getRules(): array
    {
        return [
            'user_id' => 'required|numeric|exists:user,id',
        ];
    }
}