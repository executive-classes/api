<?php

namespace App\Traits\Requests;

use App\Http\Rules\BrazilianPhone;

trait PhoneRules
{
    public function getPhoneRules(string $required = 'sometimes')
    {
        return [
            'phone' => [$required, new BrazilianPhone],
            'phone_alt' => 'sometimes|nullable',
        ];
    }
}