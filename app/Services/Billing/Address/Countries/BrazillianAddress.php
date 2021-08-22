<?php

namespace App\Services\Billing\Address\Countries;

use App\Apis\ViaCep\ViaCepClient;
use App\Enums\Billing\CountryEnum;
use App\Models\Billing\Address\Address;
use App\Models\Billing\AddressCity\AddressCity;
use App\Models\Billing\AddressState\AddressState;
use App\Services\Billing\Address\Contract\AddressMaker;

class BrazillianAddress implements AddressMaker
{
    /**
     * ViaCep Client.
     * 
     * @var ViaCepClient
     */
    private $client;

    /**
     * Create the Brazillian Address.
     *
     * @param ViaCepClient $client
     */
    public function __construct(ViaCepClient $client)
    {
        $this->client = $client;
    }

    /**
     * Create a brazillian address.
     *
     * @param array $data
     * @return Address
     */
    public function create(array $data): Address
    {
        return $this->make($data, new Address());
    }

    /**
     * Update a brazillian address.
     *
     * @param array $data
     * @param Address $address
     * @return Address
     */
    public function update(array $data, Address $address): Address
    {
        return $this->make($data, $address);
    }

    /**
     * Make the address data.
     *
     * @param array $data
     * @param Address $address
     * @return Address
     */
    private function make(array $data, Address $address): Address
    {
        $consultedAddress = $this->client->consult($data['zip']);

        $address->zip = $data['zip'];
        $address->number = $data['number'];
        $address->complement = $data['complement'] ?? null;
        $address->country = CountryEnum::BR;
        $address->street = $consultedAddress->logradouro;
        $address->district = $consultedAddress->bairro;
        $address->city = $consultedAddress->localidade;
        $address->state = $consultedAddress->uf;

        $address->save();

        return $address;
    }
}