<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\EmployeePosition;
use App\Models\Billing\UserPrivilege;
use Illuminate\Database\Seeder;

class EmployeePositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        $this->create(EmployeePosition::ADMINISTRATOR, 'Administrador.', null, [
            UserPrivilege::CROSS_AUTH,
            UserPrivilege::MESSAGE_GET,
            UserPrivilege::MESSAGE_CREATE,
            UserPrivilege::MESSAGE_CANCEL,
            UserPrivilege::MESSAGE_TEMPLATE_GET,
            UserPrivilege::MESSAGE_TEMPLATE_CREATE,
            UserPrivilege::MESSAGE_TEMPLATE_UPDATE
        ]);
        
        $this->create(EmployeePosition::FINANCIAL, 'Financeiro.', EmployeePosition::FINANCIAL, [
            UserPrivilege::MESSAGE_GET,
            UserPrivilege::MESSAGE_CREATE,
            UserPrivilege::MESSAGE_TEMPLATE_GET
        ]);

        $this->create(EmployeePosition::DEVELOPER, 'Desenvolvedor.', EmployeePosition::ADMINISTRATOR, [
            UserPrivilege::ALL
        ]);
    }

    /**
     * Create the Employee Position entry;
     *
     * @param string $id
     * @param string $name
     * @return void
     */
    protected function create(string $id, string $name, string $parent_id = null, array $privileges = []): void
    {
        $position = new EmployeePosition(compact('id', 'name', 'parent_id'));
        $position->save();
        $position->privileges()->toggle($privileges);
    }
}