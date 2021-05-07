<?php

namespace App\Enums\Billing;

use BenSampo\Enum\Enum;

final class EmployeePositionEnum extends Enum
{
    const ADMINISTRATOR = 'administrator';
    const DEVELOPER = 'developer';
    const FINANCIAL = 'financial';
    const TECHNICIAN = 'technician';
    const HR = 'HR';
}