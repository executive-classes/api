<?php

namespace Database\Factories\Billing\InvoiceItem;

use App\Models\Eloquent\Billing\Invoice\Invoice;
use App\Models\Eloquent\Billing\InvoiceItem\InvoiceItem;
use App\Models\Eloquent\Billing\Student\Student;
use Database\Factories\Factory;

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
            'invoice_id' => $this->relation(Invoice::class),
            'student_id' => $this->relation(Student::class),
            'description' => $this->faker->text,
            'qty' => $this->faker->numberBetween(0, 99),
            'unity_price' => $this->faker->randomFloat(2, 0, 999),
            'price' => $this->faker->randomFloat(2, 0, 99999),
        ];
    }
}
