<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\Collection;
use App\Models\Billing\Invoice;
use App\Traits\UsesFaker;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    use UsesFaker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Invoice::factory()
            ->for($this->faker()->randomElement(Collection::all()), 'collection')
            ->create();
    }
}