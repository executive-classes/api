<?php

namespace Database\Seeders\Billing;

use App\Enums\Billing\BillerStatusEnum;
use App\Models\Eloquent\Billing\BillerStatus\BillerStatus;
use Database\Seeders\Seeder;

class BillerStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(BillerStatusEnum::ACTIVE, 'Ativo', 'Indicates that a biller is active and realize its payments.');
        $this->create(BillerStatusEnum::SUSPENDED, 'Suspenso', 'Indicates that a biller is suspended and will not generate collections.');
        $this->create(BillerStatusEnum::CANCELED, 'Cancelado', 'Indicates that a biller is canceled and will be no more generate collections.');
        $this->create(BillerStatusEnum::INACTIVE, 'Inativo', 'Indicates that a biller is inactive.');
    }

    /**
     * Create a Biller Status entry.
     *
     * @param string $id
     * @param string $name
     * @param string $description
     * @return void
     */
    protected function create(string $id, string $name, string $description)
    {
        $billerStatus = new BillerStatus(compact('id', 'name', 'description'));
        $billerStatus->save();
    }
}
