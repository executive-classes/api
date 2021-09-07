<?php

namespace App\Enums\Billing;

use App\Enums\Enum;

final class CollectionStatusEnum extends Enum
{
    const PAYED = 'payed';
    const CHARGED = 'charged';
    const SCHEDULED = 'scheduled';
    const POSTPONED = 'postponed';
    const CANCELED = 'canceled';
    const ERROR = 'error';
}