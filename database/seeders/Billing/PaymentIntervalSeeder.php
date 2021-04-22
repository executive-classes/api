<?php

namespace Database\Seeders\Billing;

use App\Enums\Billing\PaymentIntervalEnum;
use App\Models\Billing\PaymentInterval;
use Illuminate\Database\Seeder;

class PaymentIntervalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(PaymentIntervalEnum::MENSAL, 'Mensal', 'Payments made every 1 month ');
        $this->create(PaymentIntervalEnum::BIMESTRAL, 'Bimestral', 'Payments made every 2 months ');
        $this->create(PaymentIntervalEnum::TRIMESTRAL, 'Trimestral', 'Payments made every 3 months ');
        $this->create(PaymentIntervalEnum::SEMESTRAL, 'Semestral', 'Payments made every 6 months');
        $this->create(PaymentIntervalEnum::ANUAL, 'Anual', 'Payments made every 12 months');
        $this->create(PaymentIntervalEnum::BIANUAL, 'Bianual', 'Payments made every 24 months');
    }

    /**
     * Create a Payment Interval entry.
     *
     * @param string $id
     * @param string $name
     * @param string $description
     * @return void
     */
    protected function create(string $id, string $name, string $description)
    {
        $paymentInterval = new PaymentInterval(compact('id', 'name', 'description'));
        $paymentInterval->save();
    }
}

