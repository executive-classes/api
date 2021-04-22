<?php

namespace App\Traits\Factories;

trait HasMultipleTaxTypes
{
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
            $alt ? 'tax_code' : 'tax_alt_code' => $value
        ];
    }
}