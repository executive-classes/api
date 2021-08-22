<?php

namespace Tests\Unit\Traits\Models;

use App\Enums\Billing\PaymentMethodEnum;
use App\Services\PayGo\Payment\BankSlip;
use App\Services\PayGo\Payment\CreditCard;
use App\Services\PayGo\Payment\Deposit;
use App\Services\PayGo\Payment\Pix;
use App\Services\PayGo\Payment\Transfer;

trait HasPayGoAsserts
{
    protected $payGoPaymentClasses = [
        'credit_card' => CreditCard::class,
        'bank_slip' => BankSlip::class,
        'pix' => Pix::class,
        'deposit' => Deposit::class,
        'transfer' => Transfer::class,
    ];

    public function test_paygo_get_amount()
    {
        $this->model->amount = 123.45;
        $this->assertEquals(12345, $this->model->getAmount());
    }

    public function test_get_paygo_payment()
    {
        foreach (PaymentMethodEnum::getValues() as $paymentMethod) {
            $this->model->payment_method_id = $paymentMethod;
            $paymentClass = $this->model->getPayGoPayment();

            $this->assertEquals($this->payGoPaymentClasses[$paymentMethod], get_class($paymentClass));
        }
    }
}