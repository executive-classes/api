<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\InvoiceStatus;
use Illuminate\Database\Seeder;

class InvoiceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(InvoiceStatus::GENERATED, 'Gerado', 'Indicates that a invoice was generated.');
        $this->create(InvoiceStatus::PENDING, 'Pendente', 'Indicates that a invoice is pending for generation.');
        $this->create(InvoiceStatus::ERROR, 'Erro', 'Indicates that a invoice has a error in its processing.');
    }

    /**
     * Create a Invoice Status entry.
     *
     * @param string $id
     * @param string $name
     * @param string $description
     * @return void
     */
    protected function create(string $id, string $name, string $description)
    {
        $invoiceStatus = new InvoiceStatus(compact('id', 'name', 'description'));
        $invoiceStatus->save();
    }
}