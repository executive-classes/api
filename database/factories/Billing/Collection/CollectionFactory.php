<?php

namespace Database\Factories\Billing\Collection;

use App\Models\Eloquent\Billing\Biller\Biller;
use App\Models\Eloquent\Billing\Collection\Collection;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollectionFactory extends Factory
{
    use CollectionFactoryStates;

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
}
