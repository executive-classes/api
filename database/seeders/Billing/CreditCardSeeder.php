<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\CreditCard;
use Illuminate\Database\Seeder;

class CreditCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CreditCard::factory(10)->create();
    }
}