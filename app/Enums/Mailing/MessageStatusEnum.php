<?php

namespace App\Enums\Mailing;

use BenSampo\Enum\Enum;

final class MessageStatusEnum extends Enum
{
    const SENT = 'sent';
    const SCHEDULED = 'scheduled';
    const CANCELED = 'canceled';
    const ERROR = 'error';
}