<?php

namespace App\Enums\Billing;

use App\Enums\Enum;

final class PaymentMethodEnum extends Enum
{
    const CREDIT_CARD = 'credit_card';
    const BANK_SLIP = 'bank_slip';
    const PIX = 'pix';
    const DEPOSIT = 'deposit';
    const TRANSFER = 'transfer';
}