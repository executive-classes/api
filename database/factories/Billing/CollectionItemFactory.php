<?php

namespace Database\Factories\Billing;

use App\Models\Billing\CollectionItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollectionItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CollectionItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'value' => $this->faker->randomFloat(2, 0, 10000)
        ];
    }
}
