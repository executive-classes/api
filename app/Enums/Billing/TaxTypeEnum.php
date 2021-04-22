<?php

namespace App\Enums\Billing;

use BenSampo\Enum\Enum;

final class TaxTypeEnum extends Enum
{
    const CNPJ = 'cnpj';
    const CPF = 'cpf';
    const IE = 'ie';
    const RG = 'rg';
}