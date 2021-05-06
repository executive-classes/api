<?php

namespace App\Rules;

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
        return preg_match('/^(?:(?:\+|00)?(55)\s?)?(?:\(?([0-0]?[0-9]{1}[0-9]{1})\)?\s?)??(?:((?:9[2-9]|[2-9])\d{3}\-?\d{4}))$/', $value);
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

