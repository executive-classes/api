<?php

namespace Database\Seeders\Billing;

use App\Models\Eloquent\Billing\Address\Address;
use Database\Seeders\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the local database seeds.
     *
     * @return void
     */
    protected function local()
    {
        // Creating address for every country
        Address::factory()->persist()->br()->create();
        Address::factory()->persist()->us()->create();
    }
}
