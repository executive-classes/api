<?php

namespace Database\Seeders\Billing;

use App\Enums\Billing\UserPrivilegeEnum;
use App\Models\Eloquent\Billing\UserPrivilege\UserPrivilege;
use Illuminate\Database\Seeder;

class UserPrivilegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        $this->create(UserPrivilegeEnum::ALL, 'Can do all things.');

        // Auth
        $this->create(UserPrivilegeEnum::CROSS_AUTH, 'Can cross-auth in others users.');

        // Billing
        $this->create(UserPrivilegeEnum::ADDRESS_GET, 'Can get or list addresses.');
        $this->create(UserPrivilegeEnum::ADDRESS_CREATE, 'Can create new addresses.');
        $this->create(UserPrivilegeEnum::ADDRESS_UPDATE, 'Can update a address.');
        $this->create(UserPrivilegeEnum::ADDRESS_DELETE, 'Can cancel a address.');
        $this->create(UserPrivilegeEnum::BILLER_GET, 'Can get or list billers.');
        $this->create(UserPrivilegeEnum::BILLER_CREATE, 'Can create new billers.');
        $this->create(UserPrivilegeEnum::BILLER_UPDATE, 'Can update a biller.');
        $this->create(UserPrivilegeEnum::BILLER_CANCEL, 'Can cancel a biller.');
        $this->create(UserPrivilegeEnum::CUSTOMER_GET, 'Can get or list customers.');
        $this->create(UserPrivilegeEnum::CUSTOMER_CREATE, 'Can create new customers.');
        $this->create(UserPrivilegeEnum::CUSTOMER_UPDATE, 'Can update a customer.');
        $this->create(UserPrivilegeEnum::CUSTOMER_CANCEL, 'Can cancel a customer.');
        $this->create(UserPrivilegeEnum::USER_GET, 'Can get or list users.');
        $this->create(UserPrivilegeEnum::USER_CREATE, 'Can create new users.');
        $this->create(UserPrivilegeEnum::USER_UPDATE, 'Can update a user.');
        $this->create(UserPrivilegeEnum::USER_CANCEL, 'Can cancel a user.');
        $this->create(UserPrivilegeEnum::EMPLOYEE_GET, 'Can get or list employees.');
        $this->create(UserPrivilegeEnum::EMPLOYEE_CREATE, 'Can create new employees.');
        $this->create(UserPrivilegeEnum::EMPLOYEE_UPDATE, 'Can update a employee.');
        $this->create(UserPrivilegeEnum::EMPLOYEE_CANCEL, 'Can cancel a employee.');
        $this->create(UserPrivilegeEnum::TEACHER_GET, 'Can get or list teachers.');
        $this->create(UserPrivilegeEnum::TEACHER_CREATE, 'Can create new teachers.');
        $this->create(UserPrivilegeEnum::TEACHER_UPDATE, 'Can update a teacher.');
        $this->create(UserPrivilegeEnum::TEACHER_CANCEL, 'Can cancel a teacher.');
        $this->create(UserPrivilegeEnum::STUDENT_GET, 'Can get or list students.');
        $this->create(UserPrivilegeEnum::STUDENT_CREATE, 'Can create new students.');
        $this->create(UserPrivilegeEnum::STUDENT_UPDATE, 'Can update a student.');
        $this->create(UserPrivilegeEnum::STUDENT_CANCEL, 'Can cancel a student.');

        // Mailing
        $this->create(UserPrivilegeEnum::MESSAGE_GET, 'Can get or list messages.');
        $this->create(UserPrivilegeEnum::MESSAGE_CREATE, 'Can create new messages.');
        $this->create(UserPrivilegeEnum::MESSAGE_CANCEL, 'Can cancel scheduled messages.');
        $this->create(UserPrivilegeEnum::MESSAGE_TEMPLATE_GET, 'Can get or list messages templates.');
        $this->create(UserPrivilegeEnum::MESSAGE_TEMPLATE_CREATE, 'Can create messages templates.');
        $this->create(UserPrivilegeEnum::MESSAGE_TEMPLATE_UPDATE, 'Can update messages templates.');
        $this->create(UserPrivilegeEnum::MESSAGE_TEMPLATE_DELETE, 'Can delete messages templates.');

        // System
        $this->create(UserPrivilegeEnum::BUG_LOG_GET, 'Can get the bug log.');
    }

    /**
     * Create the User Privilege entry;
     *
     * @param string $id
     * @param string $name
     * @return void
     */
    protected function create(string $id, string $description, bool $teacher_can = false, bool $student_can = false): void
    {
        $userPrivilege = new UserPrivilege(compact('id', 'description', 'teacher_can', 'student_can'));
        $userPrivilege->save();
    }
}
