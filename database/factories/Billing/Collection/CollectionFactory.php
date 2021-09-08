<?php

namespace Database\Factories\Billing\Collection;

use App\Enums\Billing\CollectionStatusEnum;
use App\Models\Eloquent\Billing\Biller\Biller;
use App\Models\Eloquent\Billing\Collection\Collection;
use Carbon\Carbon;
use Database\Factories\Factory;

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
        $biller = $this->relation(Biller::class);
        return [
            'id' => $this->id(),
            'expire_at' => Carbon::now()->addWeek(1)->toDateTimeString(),
            'biller_id' => $biller,
            'collection_status_id' => CollectionStatusEnum::getRandomValue(),
            'amount' => $this->faker->randomFloat(2, 0, 10000),
            'description' => $this->faker->text(255),
            'truncatedDescription' => $this->faker->text(22),
            'payment_interval_id' => $biller->payment_interval_id,
            'payment_method_id' => $biller->payment_method_id
        ];
    }
}
