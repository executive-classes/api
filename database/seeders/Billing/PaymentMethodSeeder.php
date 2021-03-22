<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(PaymentMethod::CREDIT_CARD, 'Cartão de Crédito', 'Payments made with Credit Card', '03');
        $this->create(PaymentMethod::BOLETO, 'Boleto Bancário', 'Payments made with Boleto', '15');
        $this->create(PaymentMethod::DEPOSIT, 'Depósito Bancário', 'Payments made with a bank deposit', '16');
        $this->create(PaymentMethod::PIX, 'PIX', 'Payments made with brazillian pix', '17');
        $this->create(PaymentMethod::TRANSFER, 'Transferência Bancária', 'Payments made with bank transfer', '18');
    }

    /**
     * Create a payment method entry.
     *
     * @param string $id
     * @param string $name
     * @param string $description
     * @return void
     */
    protected function create(string $id, string $name, string $description, string $invoice_code)
    {
        $paymentMethod = new PaymentMethod(compact('id', 'name', 'description', 'invoice_code'));
        $paymentMethod->save();
    }
}