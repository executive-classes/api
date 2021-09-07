<?php

namespace App\Enums\Mailing;

use App\Enums\Enum;

final class MessageStatusEnum extends Enum
{
    const SENT = 'sent';
    const SCHEDULED = 'scheduled';
    const CANCELED = 'canceled';
    const ERROR = 'error';
}