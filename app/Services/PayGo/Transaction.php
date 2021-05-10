<?php

namespace App\Services\PayGo;

use App\Apis\GuzzleResponse;
use App\Apis\PayGo\Gate2AllClient;
use App\Models\Billing\Biller;
use App\Models\Billing\Address;
use App\Models\Billing\Collection;
use App\Models\Billing\Customer;
use App\Services\PayGo\Contracts\PaymentContract;

class Transaction
{
    private $client;

    public function __construct(Gate2AllClient $client)
    {
        $this->client = $client;
    }

    public function check(string $transactionId): GuzzleResponse
    {
        return $this->client->consult($transactionId);
    }

    public function create(Collection $collection): GuzzleResponse
    {
        $data = [
            'referenceId' => $collection->id,
            'amount' => $collection->getAmount(),
            'description' => $collection->description,
            'customer' => $this->getCustomerData($collection->customer),
            'payment' => $this->getPaymentData($collection->getPayGoPayment())
        ];

        return $this->client->transaction($data);
    }

    public function cancel(string $transactionId): GuzzleResponse
    {
        return $this->client->cancel($transactionId);
    }

    public function saveCreditCard(Biller $biller, array $cardData): GuzzleResponse
    {
        $data = [
            "referenceId" => $biller->id,
            "cardInfo" => $cardData
        ];

        return $this->client->tokenization($data);
    }

    public function getCreditCard(string $token): GuzzleResponse
    {
        return $this->client->consultToken($token);
    }

    private function getCustomerData(Customer $customer): array
    {
        return [
            'name' => $customer->name,
            'document' => removeNonDigit($customer->tax_code),
            'email' => $customer->email,
            'address' => $this->getAddressData($customer->address)
        ];
    }

    private function getAddressData(Address $address): array
    {
        return [
            "address" => $address->street,
            "number"  => $address->number,
            "complement" => $address->complement,
            "district" => $address->district,
            "zipcode" => removeNonDigit($address->zip),
            "city" => $address->city,
            "state" => $address->state,
        ];
    }

    private function getPaymentData(PaymentContract $payment): array
    {
        return $payment->getData();
    }
}
