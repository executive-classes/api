<?php

namespace Database\Factories\Billing;

use App\Enums\Billing\CollectionStatusEnum;
use App\Models\Billing\Biller;
use App\Models\Billing\Collection;
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
        $biller = $this->faker->randomElement(Biller::all());
        return [
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
