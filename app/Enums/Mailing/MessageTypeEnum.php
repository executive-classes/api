<?php

namespace App\Enums\Mailing;

use BenSampo\Enum\Enum;

final class MessageTypeEnum extends Enum
{
    const BILLING = 'billing';
    const WARNING = 'warning';
}