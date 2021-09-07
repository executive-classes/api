<?php

namespace App\Enums\Billing;

use App\Enums\Enum;

final class PaymentIntervalEnum extends Enum
{
    const MENSAL = 1;
    const BIMESTRAL = 2;
    const TRIMESTRAL = 3;
    const SEMESTRAL = 6;
    const ANUAL = 12;
    const BIANUAL = 24;
}