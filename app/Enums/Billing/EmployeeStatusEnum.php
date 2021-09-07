<?php

namespace App\Enums\Billing;

use App\Enums\Enum;

final class EmployeeStatusEnum extends Enum
{
    const ACTIVE = 'active';
    const SUSPENDED = 'suspended';
    const CANCELED = 'canceled';

    public static function getUpdatableValues()
    {
        return [
            self::ACTIVE,
            self::SUSPENDED
        ];
    }
}