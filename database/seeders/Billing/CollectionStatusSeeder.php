<?php

namespace Database\Seeders\Billing;

use App\Enums\Billing\CollectionStatusEnum;
use App\Models\Eloquent\Billing\CollectionStatus\CollectionStatus;
use Database\Seeders\Seeder;

class CollectionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(CollectionStatusEnum::PAYED, 'Paga', 'Indicates that a collection was payed.');
        $this->create(CollectionStatusEnum::CHARGED, 'Cobrada', 'Indicates that a collection was charged.');
        $this->create(CollectionStatusEnum::SCHEDULED, 'Agendado', 'Indicates that a collection is scheduled for payment.');
        $this->create(CollectionStatusEnum::POSTPONED, 'Postergado', 'Indicates that a collection was postponed.');
        $this->create(CollectionStatusEnum::CANCELED, 'Cancelado', 'Indicates that a collection was canceled.');
        $this->create(CollectionStatusEnum::ERROR, 'Erro', 'Indicates that a collection has a error on its processing.');
    }

    /**
     * Create a Collection Status entry.
     *
     * @param string $id
     * @param string $name
     * @param string $description
     * @return void
     */
    protected function create(string $id, string $name, string $description)
    {
        $collectionStatus = new CollectionStatus(compact('id', 'name', 'description'));
        $collectionStatus->save();
    }
}