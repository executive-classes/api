<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\Address\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::factory(5)
            ->create();
    }
}
