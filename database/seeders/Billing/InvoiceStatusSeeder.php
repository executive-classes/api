<?php

namespace Database\Seeders\Billing;

use App\Enums\Billing\InvoiceStatusEnum;
use App\Models\Eloquent\Billing\InvoiceStatus\InvoiceStatus;
use Database\Seeders\Seeder;

class InvoiceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(InvoiceStatusEnum::CREATED);
        $this->create(InvoiceStatusEnum::GENERATED);
        $this->create(InvoiceStatusEnum::SENT);
        $this->create(InvoiceStatusEnum::PROCESSING);
        $this->create(InvoiceStatusEnum::OK);
        $this->create(InvoiceStatusEnum::ERROR);
    }

    /**
     * Create a Invoice Status entry.
     *
     * @param string $id
     * @return void
     */
    protected function create(string $id)
    {
        $invoiceStatus = new InvoiceStatus(compact('id'));
        $invoiceStatus->save();
    }
}