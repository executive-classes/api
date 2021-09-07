<?php

namespace App\Enums\System;

use App\Enums\Enum;

final class AuditLogTypeEnum extends Enum
{
    const INSERT = 'INSERT';
    const UPDATE = 'UPDATE';
    const DELETE = 'DELETE';
}