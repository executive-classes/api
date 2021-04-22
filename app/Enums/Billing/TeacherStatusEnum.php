<?php

namespace App\Enums\Billing;

use BenSampo\Enum\Enum;

final class TeacherStatusEnum extends Enum
{
    const ACTIVE = 'active';
    const SUSPENDED = 'suspended';
    const CANCELED = 'canceled';
    const INACTIVE = 'inactive';
}