<?php

namespace App\Enums\System;

use BenSampo\Enum\Enum;

final class AuditLogTypeEnum extends Enum
{
    const INSERT = 'INSERT';
    const UPDATE = 'UPDATE';
    const DELETE = 'DELETE';
}