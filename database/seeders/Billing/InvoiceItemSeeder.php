<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\Invoice;
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
        $invoices = Invoice::with('biller.students')->get();
        
        foreach ($invoices as $invoice) {
            foreach ($invoice->biller->students as $student) {
                InvoiceItem::factory()
                    ->for($invoice, 'invoice')
                    ->for($student, 'student')
                    ->create();
            }
        }
    }
}