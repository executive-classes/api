<?php

namespace Database\Factories\Billing\CollectionItem;

use App\Models\Eloquent\Billing\Collection\Collection;
use App\Models\Eloquent\Billing\CollectionItem\CollectionItem;
use App\Models\Eloquent\Billing\Student\Student;
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
            'collection_id' => Collection::factory(),
            'student_id' => Student::factory(),
            'amount' => $this->faker->randomFloat(2, 0, 10000)
        ];
    }
}
