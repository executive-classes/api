<?php

namespace App\Enums\Billing;

use BenSampo\Enum\Enum;

final class InvoiceStatusEnum extends Enum
{
    const CREATED = 'created';
    const GENERATED = 'generated';
    const SENT = 'sent';
    const PROCESSING = 'processing';
    const OK = 'ok';
    const ERROR = 'error';
}