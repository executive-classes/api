<?php

namespace App\Traits\Models\Billing;

use App\Exceptions\Billing\TaxTypeException;
use App\Models\Billing\TaxType;

trait HasTax
{
    public function hasTax(string $taxType): bool
    {
        return in_array($taxType, [$this->tax_type_id ?? null, $this->tax_type_alt_id ?? null]);
    }

    public function getTaxCode(string $taxType, bool $findOrFail = false)
    {
        if (!$this->hasTax($taxType) && $findOrFail) {
            throw new TaxTypeException(__('billing.tax_type.fail.get', strtoupper($taxType)), 500);
        }

        if ($taxType == $this->tax_type_id ?? null) {
            return $this->tax_code ?? null;
        }
        
        if ($taxType == $this->tax_type_alt_id ?? null) {
            return $this->tax_code_alt ?? null;
        }

        return null;
    }

    public function hasCnpj(): bool
    {
        return $this->hasTax(TaxType::CNPJ);
    }

    public function hasCpf(): bool
    {
        return $this->hasTax(TaxType::CPF);
    }

    public function hasRg(): bool
    {
        return $this->hasTax(TaxType::RG);
    }

    public function hasIe(): bool
    {
        return $this->hasTax(TaxType::IE);
    }

    public function getCnpj(bool $findOrFail = false)
    {
        return $this->getTaxCode(TaxType::CNPJ, $findOrFail);
    }

    public function getCpf(bool $findOrFail = false)
    {
        return $this->getTaxCode(TaxType::CPF, $findOrFail);
    }

    public function getRg(bool $findOrFail = false)
    {
        return $this->getTaxCode(TaxType::RG, $findOrFail);
    }

    public function getIe(bool $findOrFail = false)
    {
        return $this->getTaxCode(TaxType::IE, $findOrFail);
    }
}