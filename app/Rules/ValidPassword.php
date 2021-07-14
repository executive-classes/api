<?php

namespace App\Rules;

use App\Services\Billing\Password\Password;
use Illuminate\Contracts\Validation\Rule;

class ValidPassword implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Password::validate($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return __('validation.valid_password');
    }
}

