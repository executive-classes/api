<?php

namespace App\Traits\Factories\Billing;

use App\Enums\Billing\PaymentMethodEnum;

trait PaymentMethodStates
{
    /**
     * Indicate that the biller is payed with credit card.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function credit_card(string $token_id = null)
    {
        return $this->state(function (array $attributes) use ($token_id) {
            return [
                'payment_method_id' => PaymentMethodEnum::CREDIT_CARD,
                'token_id' => $token_id ?? config('test.paygo.token')
            ];
        });
    }

    /**
     * Indicate that the biller is payed with bank slip.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function bank_slip()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_method_id' => PaymentMethodEnum::BANK_SLIP,
            ];
        });
    }

    /**
     * Indicate that the biller is payed with brazillian pix.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function pix()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_method_id' => PaymentMethodEnum::PIX,
            ];
        });
    }

    /**
     * Indicate that the biller is payed with bank deposit.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function deposit()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_method_id' => PaymentMethodEnum::DEPOSIT,
            ];
        });
    }

    /**
     * Indicate that the biller is payed with eletronic transfer.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function transfer()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_method_id' => PaymentMethodEnum::TRANSFER,
            ];
        });
    }
}