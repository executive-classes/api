<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::factory()->create();
    }
}