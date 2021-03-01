<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\Biller;
use App\Models\Billing\Building;
use App\Models\Billing\CreditCard;
use App\Models\Billing\Customer;
use App\Models\Billing\PaymentInterval;
use App\Models\Billing\PaymentMethod;
use App\Traits\UsesFaker;
use Illuminate\Database\Seeder;

class BillerSeeder extends Seeder
{
    use UsesFaker;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Biller::factory(5)
            ->for($this->faker()->randomElement(Customer::all()), 'customer')
            ->for($this->faker()->randomElement(Building::all()), 'building')
            ->for($this->faker()->randomElement(PaymentInterval::all()), 'interval')
            ->for(PaymentMethod::find(PaymentMethod::CREDIT_CARD), 'paymentMethod')
            ->for($this->faker()->randomElement(CreditCard::all()), 'creditCard')
            ->create();

        Biller::factory(5)
            ->for($this->faker()->randomElement(Customer::all()), 'customer')
            ->for($this->faker()->randomElement(Building::all()), 'building')
            ->for($this->faker()->randomElement(PaymentInterval::all()), 'interval')
            ->for(PaymentMethod::find(PaymentMethod::BOLETO), 'paymentMethod')
            ->create();
    }
}