<?php

namespace App\Enums\Billing;

use App\Enums\Enum;

final class BillerStatusEnum extends Enum
{
    const ACTIVE = 'active';
    const SUSPENDED = 'suspended';
    const CANCELED = 'canceled';
    const INACTIVE = 'inactive';

    public static function getUpdatableValues()
    {
        return [
            self::ACTIVE,
            self::SUSPENDED
        ];
    }
}