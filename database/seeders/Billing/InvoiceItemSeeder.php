<?php

namespace Database\Seeders\Billing;

use App\Models\Eloquent\Billing\InvoiceItem\InvoiceItem;
use Database\Seeders\Seeder;

class InvoiceItemSeeder extends Seeder
{
    /**
     * Run the local database seeds.
     *
     * @return void
     */
    protected function local()
    {
        InvoiceItem::factory(5)->persist()->create();
    }
}