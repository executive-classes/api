<?php

namespace Database\Factories\Billing;

use App\Models\Billing\Invoice;
use App\Models\Billing\InvoiceItem;
use App\Models\Billing\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoiceItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'invoice_id' => Invoice::factory(),
            'student_id' => Student::factory(),
            'description' => $this->faker->text,
            'qty' => $this->faker->numberBetween(0, 99),
            'unity_price' => $this->faker->randomFloat(2, 0, 999),
            'price' => $this->faker->randomFloat(2, 0, 99999),
        ];
    }
}
