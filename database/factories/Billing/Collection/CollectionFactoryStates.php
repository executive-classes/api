<?php

namespace Database\Factories\Billing\Collection;

use App\Enums\Billing\CollectionStatusEnum;
use App\Traits\Factories\Billing\PaymentIntervalStates;
use App\Traits\Factories\Billing\PaymentMethodStates;

trait CollectionFactoryStates
{
    use PaymentMethodStates;
    use PaymentIntervalStates;

    /**
     * Indicate that the collection was payed.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function payed()
    {
        return $this->state(function (array $attributes) {
            return [
                'collection_status_id' => CollectionStatusEnum::PAYED,
            ];
        });
    }

    /**
     * Indicate that the collection was charged.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function charged()
    {
        return $this->state(function (array $attributes) {
            return [
                'collection_status_id' => CollectionStatusEnum::CHARGED,
            ];
        });
    }

    /**
     * Indicate that the collection was scheduled.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function scheduled()
    {
        return $this->state(function (array $attributes) {
            return [
                'collection_status_id' => CollectionStatusEnum::SCHEDULED,
            ];
        });
    }

    /**
     * Indicate that the collection was postponed.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function postponed()
    {
        return $this->state(function (array $attributes) {
            return [
                'collection_status_id' => CollectionStatusEnum::POSTPONED,
            ];
        });
    }

    /**
     * Indicate that the collection was canceled.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function canceled()
    {
        return $this->state(function (array $attributes) {
            return [
                'collection_status_id' => CollectionStatusEnum::CANCELED,
            ];
        });
    }

    /**
     * Indicate that the collection has a error.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function error()
    {
        return $this->state(function (array $attributes) {
            return [
                'collection_status_id' => CollectionStatusEnum::ERROR,
            ];
        });
    }
}