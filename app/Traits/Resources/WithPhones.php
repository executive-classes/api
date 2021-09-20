<?php

namespace App\Traits\Resources;

use App\Services\Billing\Phone\BrazilianPhone;

trait WithPhones
{
    private function makePhone($phone)
    {
        if (!$phone || !BrazilianPhone::validate($phone)) {
            return $phone;
        }

        return BrazilianPhone::format($phone);
    }
}