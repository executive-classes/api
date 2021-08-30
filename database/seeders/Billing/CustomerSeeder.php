<?php

namespace Database\Seeders\Billing;

use App\Models\Eloquent\Billing\Customer\Customer;
use Database\Seeders\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the local database seeds.
     *
     * @return void
     */
    protected function local()
    {
        // Creating customer for every tax
        Customer::factory()->persist()->cnpj()->create();
        Customer::factory()->persist()->cpf()->create();

        // Creating customer for every status
        Customer::factory()->persist()->active()->create();
        Customer::factory()->persist()->suspended()->create();
        Customer::factory()->persist()->canceled()->create();
        Customer::factory()->persist()->inactive()->create();
    }
}