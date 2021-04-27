<?php

namespace App\Enums\Apis;

use BenSampo\Enum\Enum;

/**
 * PayGo Status codes.
 * 
 * @source https://docs.gate2all.com.br/?json#status Status list
 */
final class PayGoStatusEnum extends Enum
{
    const STARTED = 0;
    const AWAITING_PAYMENT = 1;
    const ANALYZING = 3;
    const EXPIRED = 4;
    const AUTHORIZED = 5;
    const CONFIRMED = 6;
    const DENIED = 7;
    const CANCELING = 8;
    const CANCELED = 9;
    const CONFIRMATION_PENDING = 10;
    const SUPPLIER_COMMUNICATION_FAILED = 11;
    const CANCELED_INTENT = 12;
}