<?php

namespace App\Traits\Requests;

use App\Rules\BrazillianPhone;

trait PhoneRules
{
    public function getPhoneRules(string $required = 'sometimes')
    {
        return [
            'phone' => [$required, new BrazillianPhone],
            'phone_alt' => 'sometimes',
        ];
    }
}