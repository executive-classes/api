<?php

namespace App\Http\Requests\Billing\Student;

use App\Http\Requests\Request;

class CreateStudentRequest extends Request
{
    /**
     * Get the request rules.
     *
     * @return array
     */
    public function getRules(): array
    {
        return [
            'customer_id' => 'required|numeric|exists:customer,id',
            'biller_id' => 'required|numeric|exists:biller,id',
            'user_id' => 'required|numeric|exists:user,id',
        ];
    }
}