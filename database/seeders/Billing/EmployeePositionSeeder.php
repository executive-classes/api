<?php

namespace Database\Seeders\Billing;

use App\Enums\Billing\EmployeePositionEnum;
use App\Enums\Billing\UserPrivilegeEnum;
use App\Models\Billing\EmployeePosition;
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
        $this->create(EmployeePositionEnum::ADMINISTRATOR, 'Administrador.', null, [
            UserPrivilegeEnum::CROSS_AUTH,
            UserPrivilegeEnum::MESSAGE_GET,
            UserPrivilegeEnum::MESSAGE_CREATE,
            UserPrivilegeEnum::MESSAGE_CANCEL,
            UserPrivilegeEnum::MESSAGE_TEMPLATE_GET,
            UserPrivilegeEnum::MESSAGE_TEMPLATE_CREATE,
            UserPrivilegeEnum::MESSAGE_TEMPLATE_UPDATE
        ]);
        
        $this->create(EmployeePositionEnum::FINANCIAL, 'Financeiro.', EmployeePositionEnum::FINANCIAL, [
            UserPrivilegeEnum::MESSAGE_GET,
            UserPrivilegeEnum::MESSAGE_CREATE,
            UserPrivilegeEnum::MESSAGE_TEMPLATE_GET
        ]);

        $this->create(EmployeePositionEnum::DEVELOPER, 'Desenvolvedor.', EmployeePositionEnum::ADMINISTRATOR, [
            UserPrivilegeEnum::ALL
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