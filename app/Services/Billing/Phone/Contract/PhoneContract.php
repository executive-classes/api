<?php

namespace App\Services\Billing\Phone\Contract;

interface PhoneContract
{
    public static function validate($phone): bool;
    public static function format($phone): string;
}