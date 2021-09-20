<?php

namespace App\Services\Billing\Phone;

use App\Services\Billing\Phone\Contract\PhoneContract;

class BrazilianPhone implements PhoneContract
{
    public static function validate($phone): bool
    {
        if (!is_string($phone)) {
            return false;
        }

        return preg_match('/^(?:(?:\+|00)?(55)\s?)?(?:\(?([0-0]?[0-9]{1}[0-9]{1})\)?\s?)??(?:((?:9[2-9]|[2-9])\d{3}\-?\d{4}))$/', removeNonDigit($phone));
    }

    public static function format($phone): string
    {
        $phone = removeNonDigit($phone);

        if (!self::validate($phone)) {
            return '';
        }

        return format_mask(['(##) ####-####', '(##) #####-####'], $phone);
    }
}