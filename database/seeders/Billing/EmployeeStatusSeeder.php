<?php

namespace Database\Seeders\Billing;

use App\Enums\Billing\EmployeeStatusEnum;
use App\Models\Eloquent\Billing\EmployeeStatus\EmployeeStatus;
use Database\Seeders\Seeder;

class EmployeeStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(EmployeeStatusEnum::ACTIVE);
        $this->create(EmployeeStatusEnum::SUSPENDED);
        $this->create(EmployeeStatusEnum::CANCELED);
    }

    /**
     * Create a Employee Status entry.
     *
     * @param string $id
     * @return void
     */
    protected function create(string $id)
    {
        $employeeStatus = new EmployeeStatus(compact('id'));
        $employeeStatus->save();
    }
}