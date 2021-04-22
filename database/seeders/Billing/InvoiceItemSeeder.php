<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\InvoiceItem;
use Illuminate\Database\Seeder;

class InvoiceItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InvoiceItem::factory()->create();
    }
}