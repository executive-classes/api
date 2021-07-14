<?php

namespace App\Traits\Models\Billing;

use App\Enums\Billing\TaxTypeEnum;
use App\Exceptions\Billing\TaxTypeException;

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
        return $this->hasTax(TaxTypeEnum::CNPJ);
    }

    public function hasCpf(): bool
    {
        return $this->hasTax(TaxTypeEnum::CPF);
    }

    public function hasRg(): bool
    {
        return $this->hasTax(TaxTypeEnum::RG);
    }

    public function hasIe(): bool
    {
        return $this->hasTax(TaxTypeEnum::IE);
    }

    public function getCnpj(bool $findOrFail = false)
    {
        return $this->getTaxCode(TaxTypeEnum::CNPJ, $findOrFail);
    }

    public function getCpf(bool $findOrFail = false)
    {
        return $this->getTaxCode(TaxTypeEnum::CPF, $findOrFail);
    }

    public function getRg(bool $findOrFail = false)
    {
        return $this->getTaxCode(TaxTypeEnum::RG, $findOrFail);
    }

    public function getIe(bool $findOrFail = false)
    {
        return $this->getTaxCode(TaxTypeEnum::IE, $findOrFail);
    }

    public function setTaxCodeAttribute(string $value)
    {
        $this->attributes['tax_code'] = $value ? sanitazeTax($value) : null;
    }

    public function setTaxCodeAltAttribute(string $value = null)
    {
        $this->attributes['tax_code_alt'] = $value ? sanitazeTax($value) : null;
    }
}