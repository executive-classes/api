<?php

namespace App\Services\PayGo;

use App\Apis\GuzzleResponse;
use App\Apis\PayGo\Gate2AllClient;
use App\Models\Billing\Biller;
use App\Models\Billing\Building;
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
            'address' => $this->getAddressData($customer->building)
        ];
    }

    private function getAddressData(Building $building): array
    {
        return [
            "address" => $building->street,
            "number"  => $building->number,
            "complement" => $building->complement,
            "district" => $building->district,
            "zipcode" => removeNonDigit($building->zip_code),
            "city" => $building->city,
            "state" => $building->state,
        ];
    }

    private function getPaymentData(PaymentContract $payment): array
    {
        return $payment->getData();
    }
}
