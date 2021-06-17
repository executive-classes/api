<?php

namespace App\Traits\Models\Billing;

use App\Enums\Billing\TaxTypeEnum;
use App\Exceptions\Billing\TaxTypeException;

trait HasPhone
{
    public function setPhoneAttribute(string $value)
    {
        $this->attributes['phone'] = removeNonDigit($value);
    }

    public function setPhoneAltAttribute(string $value)
    {
        $this->attributes['phone_alt'] = removeNonDigit($value);
    }
}
