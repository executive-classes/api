<?php

namespace Database\Factories\Billing\Collection;

use App\Enums\Billing\CollectionStatusEnum;
use App\Enums\Billing\PaymentMethodEnum;
use App\Models\Billing\Biller\Biller;
use App\Models\Billing\Collection\Collection;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Collection::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'expire_at' => Carbon::now()->addWeek(1)->toDateTimeString(),
            'biller_id' => Biller::factory(),
            'amount' => $this->faker->randomFloat(2, 0, 10000),
            'description' => $this->faker->text(255),
            'truncatedDescription' => $this->faker->text(22),
            'payment_interval_id' => function (array $attributes) {
                return Biller::find($attributes['biller_id'])->payment_interval_id;
            },
            'payment_method_id' => function (array $attributes) {
                return Biller::find($attributes['biller_id'])->payment_method_id;
            }
        ];
    }

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

    /**
     * Indicate that the collection is payed with credit card.
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
     * Indicate that the collection is payed with bank slip.
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
     * Indicate that the collection is payed with brazillian pix.
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
     * Indicate that the collection is payed with bank deposit.
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
     * Indicate that the collection is payed with eletronic transfer.
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
