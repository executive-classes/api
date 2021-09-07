<?php

namespace App\Enums\Mailing;

use App\Enums\Enum;

final class MessageTypeEnum extends Enum
{
    const BILLING = 'billing';
    const WARNING = 'warning';
}