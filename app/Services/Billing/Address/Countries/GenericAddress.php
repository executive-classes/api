<?php

namespace App\Services\Billing\Address\Countries;

use App\Models\Eloquent\Billing\Address\Address;
use App\Services\Billing\Address\Contract\AddressMaker;

class GenericAddress implements AddressMaker
{
    /**
     * Create a generic address.
     *
     * @param array $data
     * @return Address
     */
    public function create(array $data): Address
    {
        $address = new Address($data);
        $address->save();
        return $address;
    }

    /**
     * Update a generic address.
     *
     * @param array $data
     * @param Address $address
     * @return Address
     */
    public function update(array $data, Address $address): Address
    {
        $address->fill($data);
        $address->save();
        return $address;
    }
}