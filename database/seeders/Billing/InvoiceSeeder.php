<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\Invoice;
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