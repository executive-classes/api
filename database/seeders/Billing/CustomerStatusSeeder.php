<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\CustomerStatus;
use Illuminate\Database\Seeder;

class CustomerStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(CustomerStatus::ACTIVE, 'Ativo', 'Indicates that a customer is active and had to pay for its services.');
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
