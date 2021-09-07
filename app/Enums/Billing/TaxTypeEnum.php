<?php

namespace App\Enums\Billing;

use App\Enums\Enum;

final class TaxTypeEnum extends Enum
{
    const CNPJ = 'cnpj';
    const CPF = 'cpf';
    const IE = 'ie';
    const RG = 'rg';
}