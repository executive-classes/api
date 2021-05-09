<?php

namespace App\Enums\Billing;

use BenSampo\Enum\Enum;

final class TeacherStatusEnum extends Enum
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