<?php

namespace App\Services\Billing\Tax\Contract;

abstract class Tax
{
    abstract public function validate(string $tax): bool;

    public function mask(string $tax): string
    {
        return format_mask($this->mask, $tax);
    }

    public function sanitize(string $tax, string $regex = '/\D/'): string
    {
        return preg_replace($regex, '', $tax);
    }
}

