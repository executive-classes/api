<?php

namespace Database\Factories\Billing\CollectionStatus;

use App\Enums\Billing\CollectionStatusEnum;
use App\Models\Eloquent\Billing\CollectionStatus\CollectionStatus;
use Database\Factories\Factory;

class CollectionStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CollectionStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => CollectionStatusEnum::getRandomValue()
        ];
    }
}