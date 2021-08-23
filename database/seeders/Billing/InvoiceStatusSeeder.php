<?php

namespace Database\Seeders\Billing;

use App\Enums\Billing\InvoiceStatusEnum;
use App\Models\Eloquent\Billing\InvoiceStatus\InvoiceStatus;
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
        $this->create(InvoiceStatusEnum::CREATED, 'Criada', 'Indicates that a invoice was created.');
        $this->create(InvoiceStatusEnum::GENERATED, 'Gerada', 'Indicates that a invoice and its XML was created.');
        $this->create(InvoiceStatusEnum::SENT, 'Enviada', 'Indicates that a invoice was sent to processing.');
        $this->create(InvoiceStatusEnum::PROCESSING, 'Em processamento', 'Indicates that a invoice its during processing.');
        $this->create(InvoiceStatusEnum::OK, 'Emitida', 'Indicates that a invoice was sent and it is ok.');
        $this->create(InvoiceStatusEnum::ERROR, 'Erro', 'Indicates that a invoice was sent but ocorred a error.');
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