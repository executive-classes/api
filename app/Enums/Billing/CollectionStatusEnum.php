<?php

namespace App\Enums\Billing;

use BenSampo\Enum\Enum;

final class CollectionStatusEnum extends Enum
{
    const PAYED = 'payed';
    const SCHEDULED = 'scheduled';
    const POSTPONED = 'postponed';
    const CANCELED = 'canceled';
    const ERROR = 'error';
}