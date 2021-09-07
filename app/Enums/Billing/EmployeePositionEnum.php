<?php

namespace App\Enums\Billing;

use App\Enums\Enum;

final class EmployeePositionEnum extends Enum
{
    const ADMINISTRATOR = 'administrator';
    const DEVELOPER = 'developer';
    const FINANCIAL = 'financial';
    const TECHNICIAN = 'technician';
    const HR = 'hr';
}