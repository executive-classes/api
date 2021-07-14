<?php

namespace App\Traits\Models\Billing;

trait HasPhone
{
    public function setPhoneAttribute(string $value = null)
    {
        $this->attributes['phone'] = $value ? removeNonDigit($value) : null;
    }

    public function setPhoneAltAttribute(string $value = null)
    {
        $this->attributes['phone_alt'] = $value ? removeNonDigit($value) : null;
    }
}
