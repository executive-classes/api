<?php

namespace Database\Factories\Billing\Invoice;

use Database\Factories\Factory;
use App\Models\Eloquent\Billing\Invoice\Invoice;
use App\Models\Eloquent\Billing\Collection\Collection;
use Database\Factories\Billing\Invoice\InvoiceFactoryStates;

class InvoiceFactory extends Factory
{
    use InvoiceFactoryStates;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'collection_id' => $this->relation(Collection::class)
        ];
    }
}
