<?php

namespace Database\Seeders\Billing;

use App\Models\Eloquent\Billing\Customer\Customer;
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