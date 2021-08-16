<?php

namespace Tests\Providers\Billing;

use App\Enums\Billing\PaymentMethodEnum;
use App\Models\Billing\Collection;
use Closure;

trait CollectionProvider
{
    /**
     * Providers
     */

    public function getCollectionsWithTradableMethods()
    {
        return [
            'credit-card' => [$this->getCollectionsWithTradableMethodsFunction(PaymentMethodEnum::CREDIT_CARD())],
            'bank-slip' => [$this->getCollectionsWithTradableMethodsFunction(PaymentMethodEnum::BANK_SLIP())],
        ];
    }

    public function getCollectionsWithUntradableMethods()
    {
        return [
            'depoist' => [$this->getCollectionsWithUntradableMethodsFunction(PaymentMethodEnum::DEPOSIT())],
            'pix' => [$this->getCollectionsWithTradableMethodsFunction(PaymentMethodEnum::PIX())],
            'transfer' => [$this->getCollectionsWithUntradableMethodsFunction(PaymentMethodEnum::TRANSFER())],
        ];
    }

    /**
     * Providers Functions
     */

    private function getCollectionsWithTradableMethodsFunction(PaymentMethodEnum $method): Closure
    {
        return function () use ($method) { return [$this->makeWithCustomPaymentMethod($method)]; };
    }

    private function getCollectionsWithUntradableMethodsFunction(PaymentMethodEnum $method): Closure
    {
        return function () use ($method) { return [$this->makeWithCustomPaymentMethod($method)]; };
    }

    /**
     * Makers
     */

    public function makeWithCustomPaymentMethod(PaymentMethodEnum $method): Collection
    {
        return Collection::factory()->{$method->value}()->create();
    }
}