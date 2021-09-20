<?php

namespace App\Http\Rules;

use App\Services\Billing\Phone\BrazilianPhone as PhoneBrazilianPhone;
use Illuminate\Contracts\Validation\Rule;

/**
 * @source https://medium.com/@mariojr.rcosta/php-dica-rápida-validando-números-de-telefone-com-regex-e-preg-match-802723dbc2e9
 */
class BrazilianPhone implements Rule
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

        $phone = new PhoneBrazilianPhone();
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

