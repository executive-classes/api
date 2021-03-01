<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\EmployeeStatus;
use Illuminate\Database\Seeder;

class EmployeeStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(EmployeeStatus::ACTIVE, 'Ativo', 'Indicates that a employee is active and can use the system.');
        $this->create(EmployeeStatus::SUSPENDED, 'Suspenso', 'Indicates that a employee is suspended and can not use the system.');
        $this->create(EmployeeStatus::CANCELED, 'Cancelado', 'Indicates that a employee is canceled and will no more use the system.');
        $this->create(EmployeeStatus::INACTIVE, 'Inativo', 'Indicates that a employee is inactive.');
    }

    /**
     * Create a Employee Status entry.
     *
     * @param string $id
     * @param string $name
     * @param string $description
     * @return void
     */
    protected function create(string $id, string $name, string $description)
    {
        $employeeStatus = new EmployeeStatus(compact('id', 'name', 'description'));
        $employeeStatus->save();
    }
}