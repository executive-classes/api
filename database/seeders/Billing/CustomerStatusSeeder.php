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
        $this->create(CustomerStatusEnum::ACTIVE);
        $this->create(CustomerStatusEnum::SUSPENDED);
        $this->create(CustomerStatusEnum::CANCELED);
        $this->create(CustomerStatusEnum::INACTIVE);
    }

    /**
     * Create a Customer Status entry.
     *
     * @param string $id
     * @return void
     */
    protected function create(string $id)
    {
        $customerStatus = new CustomerStatus(compact('id'));
        $customerStatus->save();
    }
}
