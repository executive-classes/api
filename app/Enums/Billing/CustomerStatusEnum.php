<?php

namespace App\Enums\Billing;

use BenSampo\Enum\Enum;

final class CustomerStatusEnum extends Enum
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