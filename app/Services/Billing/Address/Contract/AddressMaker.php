<?php

namespace App\Services\Billing\Address\Contract;

use App\Models\Billing\Address;

interface AddressMaker
{
    public function create(array $data): Address;
    public function update(array $data, Address $address): Address;
}