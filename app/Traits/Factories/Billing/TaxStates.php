<?php

namespace App\Traits\Factories\Billing;

use App\Enums\Billing\TaxTypeEnum;

trait TaxStates
{
    /**
     * Indicate that the biller has a CNPJ.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function cnpj(bool $alt = false)
    {
        return $this->state(function (array $attributes) use ($alt) {
            return $this->getTaxTypeColumns(
                TaxTypeEnum::CNPJ,
                $this->faker->unique()->cnpj,
                $alt
            );
        });
    }

    /**
     * Indicate that the biller has a CPF.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function cpf(bool $alt = false)
    {
        return $this->state(function (array $attributes) use ($alt) {
            return $this->getTaxTypeColumns(
                TaxTypeEnum::CPF,
                $this->faker->unique()->cpf,
                $alt
            );
        });
    }

    /**
     * Indicate that the biller has a RG.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function rg(bool $alt = false)
    {
        return $this->state(function (array $attributes) use ($alt) {
            return $this->getTaxTypeColumns(
                TaxTypeEnum::RG,
                $this->faker->unique()->randomNumber(10),
                $alt
            );
        });
    }

    /**
     * Indicate that the biller has a IE.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function ie(bool $alt = false)
    {
        return $this->state(function (array $attributes) use ($alt) {
            return $this->getTaxTypeColumns(
                TaxTypeEnum::IE,
                $this->faker->unique()->randomNumber(10),
                $alt
            );
        });
    }

    /**
     * Return the array with the tax type.
     *
     * @param string $type
     * @param string $value
     * @param boolean $alt
     * @return array
     */
    private function getTaxTypeColumns(string $type, string $value, bool $alt = false): array
    {
        return [
            $alt ? 'tax_type_id' : 'tax_type_alt_id' => $type,
            $alt ? 'tax_code' : 'tax_code_alt' => $value
        ];
    }
}