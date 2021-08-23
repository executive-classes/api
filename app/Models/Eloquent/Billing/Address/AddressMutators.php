<?php

namespace App\Models\Eloquent\Billing\Address;

trait AddressMutators
{
    /**
     * Zip attribute mutator.
     *
     * @param string $value
     * @return void
     */
    public function setZipAttribute(string $value)
    {
        $this->attributes['zip'] = preg_replace('/-/', '', $value);
    }
}