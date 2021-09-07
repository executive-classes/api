<?php

namespace Database\Seeders\Billing;

use App\Enums\Billing\PaymentIntervalEnum;
use App\Models\Eloquent\Billing\PaymentInterval\PaymentInterval;
use Database\Seeders\Seeder;

class PaymentIntervalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(PaymentIntervalEnum::MENSAL);
        $this->create(PaymentIntervalEnum::BIMESTRAL);
        $this->create(PaymentIntervalEnum::TRIMESTRAL);
        $this->create(PaymentIntervalEnum::SEMESTRAL);
        $this->create(PaymentIntervalEnum::ANUAL);
        $this->create(PaymentIntervalEnum::BIANUAL);
    }

    /**
     * Create a Payment Interval entry.
     *
     * @param string $id
     * @return void
     */
    protected function create(string $id)
    {
        $paymentInterval = new PaymentInterval(compact('id'));
        $paymentInterval->save();
    }
}

