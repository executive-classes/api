<?php

namespace Database\Seeders\Billing;

use App\Enums\Billing\PaymentMethodEnum;
use App\Models\Eloquent\Billing\PaymentMethod\PaymentMethod;
use Database\Seeders\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(PaymentMethodEnum::CREDIT_CARD, '03');
        $this->create(PaymentMethodEnum::BANK_SLIP, '15');
        $this->create(PaymentMethodEnum::DEPOSIT, '16');
        $this->create(PaymentMethodEnum::PIX, '17');
        $this->create(PaymentMethodEnum::TRANSFER, '18');
    }

    /**
     * Create a payment method entry.
     *
     * @param string $id
     * @param string $invoice_code
     * @return void
     */
    protected function create(string $id, string $invoice_code)
    {
        $paymentMethod = new PaymentMethod(compact('id', 'invoice_code'));
        $paymentMethod->save();
    }
}