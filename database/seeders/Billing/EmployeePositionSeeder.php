<?php

namespace Database\Seeders\Billing;

use App\Enums\Billing\EmployeePositionEnum;
use App\Enums\Billing\UserPrivilegeEnum;
use App\Models\Eloquent\Billing\EmployeePosition\EmployeePosition;
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
        $this->create(EmployeePositionEnum::ADMINISTRATOR, 'Administrador', null, [
            UserPrivilegeEnum::ALL
        ]);
        
        // Dev
        $this->create(EmployeePositionEnum::DEVELOPER, 'Desenvolvedor', EmployeePositionEnum::ADMINISTRATOR, [
            UserPrivilegeEnum::ALL
        ]);
        
        // Finan
        $this->create(EmployeePositionEnum::FINANCIAL, 'Financeiro', EmployeePositionEnum::ADMINISTRATOR, [
            UserPrivilegeEnum::ADDRESS_GET,
            UserPrivilegeEnum::ADDRESS_CREATE,
            UserPrivilegeEnum::ADDRESS_UPDATE,
            UserPrivilegeEnum::CUSTOMER_GET,
            UserPrivilegeEnum::CUSTOMER_CREATE,
            UserPrivilegeEnum::CUSTOMER_UPDATE,
            UserPrivilegeEnum::BILLER_GET,
            UserPrivilegeEnum::BILLER_CREATE,
            UserPrivilegeEnum::BILLER_UPDATE,
            UserPrivilegeEnum::STUDENT_GET,
            UserPrivilegeEnum::STUDENT_UPDATE,
            UserPrivilegeEnum::MESSAGE_GET,
            UserPrivilegeEnum::MESSAGE_CREATE,
            UserPrivilegeEnum::MESSAGE_TEMPLATE_GET
        ]);

        // Tech
        $this->create(EmployeePositionEnum::TECHNICIAN, 'Técnico', EmployeePositionEnum::ADMINISTRATOR, [
            UserPrivilegeEnum::ADDRESS_GET,
            UserPrivilegeEnum::ADDRESS_UPDATE,
            UserPrivilegeEnum::CUSTOMER_GET,
            UserPrivilegeEnum::CUSTOMER_UPDATE,
            UserPrivilegeEnum::BILLER_GET,
            UserPrivilegeEnum::BILLER_UPDATE,
            UserPrivilegeEnum::USER_GET,
            UserPrivilegeEnum::USER_UPDATE,
            UserPrivilegeEnum::EMPLOYEE_GET,
            UserPrivilegeEnum::EMPLOYEE_UPDATE,
            UserPrivilegeEnum::TEACHER_GET,
            UserPrivilegeEnum::TEACHER_UPDATE,
            UserPrivilegeEnum::STUDENT_GET,
            UserPrivilegeEnum::STUDENT_UPDATE,
            UserPrivilegeEnum::MESSAGE_GET,
            UserPrivilegeEnum::MESSAGE_CREATE,
            UserPrivilegeEnum::MESSAGE_TEMPLATE_GET,
            UserPrivilegeEnum::BUG_LOG_GET
        ]);

        // Hr
        $this->create(EmployeePositionEnum::HR, 'Recursos Humanos', EmployeePositionEnum::ADMINISTRATOR, [
            UserPrivilegeEnum::USER_GET,
            UserPrivilegeEnum::USER_CREATE,
            UserPrivilegeEnum::USER_UPDATE,
            UserPrivilegeEnum::USER_CANCEL,
            UserPrivilegeEnum::EMPLOYEE_GET,
            UserPrivilegeEnum::EMPLOYEE_CREATE,
            UserPrivilegeEnum::EMPLOYEE_UPDATE,
            UserPrivilegeEnum::EMPLOYEE_CANCEL,
            UserPrivilegeEnum::TEACHER_GET,
            UserPrivilegeEnum::TEACHER_CREATE,
            UserPrivilegeEnum::TEACHER_UPDATE,
            UserPrivilegeEnum::TEACHER_CANCEL,
            UserPrivilegeEnum::MESSAGE_GET,
            UserPrivilegeEnum::MESSAGE_CREATE,
            UserPrivilegeEnum::MESSAGE_TEMPLATE_GET
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