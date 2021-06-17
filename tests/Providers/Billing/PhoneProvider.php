<?php

namespace Tests\Providers\Billing;

trait PhoneProvider
{
    public function getValidBrazillianPhone()
    {
        return [
            'phone' => ['1158684568', '(11) 5868-4568'],
            'cellphone' => ['11958684568', '(11) 95868-4568'],
        ];
    }

    public function getInvalidBrazillianPhone()
    {
        return [
            'phone' => ['0000000000', '(00) 0000-0000'],
            'cellphone' => ['00000000000', '(00) 00000-0000'],
        ];
    }
}
