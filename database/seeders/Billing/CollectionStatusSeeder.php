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
        $this->create(CollectionStatusEnum::PAYED);
        $this->create(CollectionStatusEnum::CHARGED);
        $this->create(CollectionStatusEnum::SCHEDULED);
        $this->create(CollectionStatusEnum::POSTPONED);
        $this->create(CollectionStatusEnum::CANCELED);
        $this->create(CollectionStatusEnum::ERROR);
    }

    /**
     * Create a Collection Status entry.
     *
     * @param string $id
     * @return void
     */
    protected function create(string $id)
    {
        $collectionStatus = new CollectionStatus(compact('id'));
        $collectionStatus->save();
    }
}