<?php

namespace Database\Seeders\Billing;

use App\Models\Eloquent\Billing\Invoice\Invoice;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Invoice::factory()->create();
    }
}