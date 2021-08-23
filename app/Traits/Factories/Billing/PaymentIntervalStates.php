<?php

namespace App\Traits\Factories\Billing;

use App\Enums\Billing\PaymentIntervalEnum;

trait PaymentIntervalStates
{
    /**
     * Indicate that the biller was charged every month.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function mensal()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_interval_id' => PaymentIntervalEnum::MENSAL,
            ];
        });
    }

    /**
     * Indicate that the biller was charged every 2 months.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function bimestral()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_interval_id' => PaymentIntervalEnum::BIMESTRAL,
            ];
        });
    }

    /**
     * Indicate that the biller was charged every 3 months.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function trimestral()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_interval_id' => PaymentIntervalEnum::TRIMESTRAL,
            ];
        });
    }

    /**
     * Indicate that the biller was charged every 6 months.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function semestral()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_interval_id' => PaymentIntervalEnum::SEMESTRAL,
            ];
        });
    }

    /**
     * Indicate that the biller was charged every 12 months.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function anual()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_interval_id' => PaymentIntervalEnum::ANUAL,
            ];
        });
    }

    /**
     * Indicate that the biller was charged every 24 months.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function bianual()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_interval_id' => PaymentIntervalEnum::BIANUAL,
            ];
        });
    }
}