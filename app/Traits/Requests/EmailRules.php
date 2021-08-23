<?php

namespace App\Traits\Requests;

trait EmailRules
{
    public function getEmailRules(string $required = 'sometimes')
    {
        return [
            'email' => "$required|nullable|email",
        ];
    }
}