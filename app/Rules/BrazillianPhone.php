<?php

namespace App\Rules;

use App\Services\Billing\Phone\BrazillianPhone as PhoneBrazillianPhone;
use Illuminate\Contracts\Validation\Rule;

/**
 * @source https://medium.com/@mariojr.rcosta/php-dica-rápida-validando-números-de-telefone-com-regex-e-preg-match-802723dbc2e9
 */
class BrazillianPhone implements Rule
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
        if (!$value) {
            return false;
        }

        $phone = new PhoneBrazillianPhone();
        return $phone->validate($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return __('validation.phone');
    }
}

