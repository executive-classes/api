<?php

namespace Database\Seeders\Billing;

use App\Models\Eloquent\Billing\Invoice\Invoice;
use Database\Seeders\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the local database seeds.
     *
     * @return void
     */
    protected function local()
    {
        // Creating invoice for every status
        Invoice::factory()->persist()->created()->create();
        Invoice::factory()->persist()->generated()->create();
        Invoice::factory()->persist()->sent()->create();
        Invoice::factory()->persist()->processing()->create();
        Invoice::factory()->persist()->ok()->create();
        Invoice::factory()->persist()->error()->create();
    }
}