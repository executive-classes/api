<?php

namespace Database\Seeders\Billing;

use App\Enums\Billing\CustomerStatusEnum;
use App\Models\Eloquent\Billing\CustomerStatus\CustomerStatus;
use Database\Seeders\Seeder;

class CustomerStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(CustomerStatusEnum::ACTIVE, 'Ativo', 'Indicates that a customer is active and had to pay for its services.');
        $this->create(CustomerStatusEnum::SUSPENDED, 'Suspenso', 'Indicates that a customer is suspended and will not generate collections.');
        $this->create(CustomerStatusEnum::CANCELED, 'Cancelado', 'Indicates that a customer is canceled and will be no more a client.');
        $this->create(CustomerStatusEnum::INACTIVE, 'Inativo', 'Indicates that a customer is inactive and is no more a client.');
    }

    /**
     * Create a Customer Status entry.
     *
     * @param string $id
     * @param string $name
     * @param string $description
     * @return void
     */
    protected function create(string $id, string $name, string $description)
    {
        $customerStatus = new CustomerStatus(compact('id', 'name', 'description'));
        $customerStatus->save();
    }
}
