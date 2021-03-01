<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\Building;
use App\Models\Billing\Customer;
use App\Traits\UsesFaker;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    use UsesFaker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::factory(3)
            ->for($this->faker()->randomElement(Building::all()), 'building')
            ->create();
    }
}