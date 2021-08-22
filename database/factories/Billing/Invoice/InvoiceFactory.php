<?php

namespace Database\Factories\Billing\Invoice;

use App\Enums\Billing\InvoiceStatusEnum;
use App\Models\Billing\Collection\Collection;
use App\Models\Billing\Invoice\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
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
            'collection_id' => Collection::factory()
        ];
    }

    /**
     * Indicate that the invoice was created.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function created()
    {
        return $this->state(function (array $attributes) {
            return [
                'invoice_status_id' => InvoiceStatusEnum::CREATED,
            ];
        });
    }

    /**
     * Indicate that the invoice was generated.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function generated()
    {
        return $this->state(function (array $attributes) {
            return [
                'invoice_status_id' => InvoiceStatusEnum::GENERATED,
            ];
        });
    }

    /**
     * Indicate that the invoice was sent.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function sent()
    {
        return $this->state(function (array $attributes) {
            return [
                'invoice_status_id' => InvoiceStatusEnum::SENT,
            ];
        });
    }

    /**
     * Indicate that the invoice is in processing.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function processing()
    {
        return $this->state(function (array $attributes) {
            return [
                'invoice_status_id' => InvoiceStatusEnum::PROCESSING,
            ];
        });
    }

    /**
     * Indicate that the invoice is ok.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function ok()
    {
        return $this->state(function (array $attributes) {
            return [
                'invoice_status_id' => InvoiceStatusEnum::OK,
            ];
        });
    }

    /**
     * Indicate that the invoice has a error.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function error()
    {
        return $this->state(function (array $attributes) {
            return [
                'invoice_status_id' => InvoiceStatusEnum::ERROR,
            ];
        });
    }
}
