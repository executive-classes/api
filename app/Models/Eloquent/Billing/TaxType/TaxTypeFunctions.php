<?php

namespace App\Models\Eloquent\Billing\TaxType;

use Illuminate\Support\Str;
use App\Enums\Billing\StateEnum;
use App\Services\Billing\Tax\Contract\Tax;

trait TaxTypeFunctions
{
    /**
     * Get a instance of a Tax.
     *
     * @return Tax
     */
    public function tax(): Tax
    {
        $tax = 'App\\Services\\Billing\\Tax\\' . Str::ucfirst($this->id);
        return new $tax();
    }

    /**
     * Validate a tax.
     *
     * @param string $value
     * @param StateEnum $state
     * @return boolean
     */
    public function validate(string $value, StateEnum $state = null): bool
    {
        return $this->tax()->validate($value, $state);
    }

    /**
     * Mask a tax.
     *
     * @param string $value
     * @param StateEnum $state
     * @return string
     */
    public function mask(string $value, StateEnum $state = null): string
    {
        return $this->tax()->mask($value, $state);
    }
}