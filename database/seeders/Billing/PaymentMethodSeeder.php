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
        $this->create(PaymentMethod::CREDIT_CARD, 'Cartão de Crédito', 'Payments made with Credit Card');
        $this->create(PaymentMethod::BOLETO, 'Boleto Bancário', 'Payments made with Boleto');
        $this->create(PaymentMethod::PIX, 'PIX', 'Payments made with brazillian pix');
        $this->create(PaymentMethod::DEPOSIT, 'Depósito Bancário', 'Payments made with a bank deposit');
    }

    /**
     * Create a payment method entry.
     *
     * @param string $id
     * @param string $name
     * @param string $description
     * @return void
     */
    protected function create(string $id, string $name, string $description)
    {
        $paymentMethod = new PaymentMethod(compact('id', 'name', 'description'));
        $paymentMethod->save();
    }
}