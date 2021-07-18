<?php

namespace App\Traits\Resources;

use App\Services\Billing\Phone\BrazillianPhone;

trait WithPhones
{
    private function makePhone($phone)
    {
        if (!$phone || !BrazillianPhone::validate($phone)) {
            return $phone;
        }

        return BrazillianPhone::format($phone);
    }
}