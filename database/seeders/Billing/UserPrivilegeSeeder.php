<?php

namespace Database\Seeders\Billing;

use App\Enums\Billing\UserPrivilegeEnum;
use App\Models\Eloquent\Billing\UserPrivilege\UserPrivilege;
use Database\Seeders\Seeder;

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
        $this->create(UserPrivilegeEnum::ALL);

        // Auth
        $this->create(UserPrivilegeEnum::CROSS_AUTH);

        // Billing
        $this->create(UserPrivilegeEnum::ADDRESS_GET);
        $this->create(UserPrivilegeEnum::ADDRESS_CREATE);
        $this->create(UserPrivilegeEnum::ADDRESS_UPDATE);
        $this->create(UserPrivilegeEnum::ADDRESS_DELETE);
        $this->create(UserPrivilegeEnum::BILLER_GET);
        $this->create(UserPrivilegeEnum::BILLER_CREATE);
        $this->create(UserPrivilegeEnum::BILLER_UPDATE);
        $this->create(UserPrivilegeEnum::BILLER_CANCEL);
        $this->create(UserPrivilegeEnum::CUSTOMER_GET);
        $this->create(UserPrivilegeEnum::CUSTOMER_CREATE);
        $this->create(UserPrivilegeEnum::CUSTOMER_UPDATE);
        $this->create(UserPrivilegeEnum::CUSTOMER_CANCEL);
        $this->create(UserPrivilegeEnum::EMPLOYEE_GET);
        $this->create(UserPrivilegeEnum::EMPLOYEE_CREATE);
        $this->create(UserPrivilegeEnum::EMPLOYEE_UPDATE);
        $this->create(UserPrivilegeEnum::EMPLOYEE_CANCEL);
        $this->create(UserPrivilegeEnum::TEACHER_GET);
        $this->create(UserPrivilegeEnum::TEACHER_CREATE);
        $this->create(UserPrivilegeEnum::TEACHER_UPDATE);
        $this->create(UserPrivilegeEnum::TEACHER_CANCEL);
        $this->create(UserPrivilegeEnum::STUDENT_GET);
        $this->create(UserPrivilegeEnum::STUDENT_CREATE);
        $this->create(UserPrivilegeEnum::STUDENT_UPDATE);
        $this->create(UserPrivilegeEnum::STUDENT_CANCEL);
        $this->create(UserPrivilegeEnum::USER_GET);
        $this->create(UserPrivilegeEnum::USER_CREATE);
        $this->create(UserPrivilegeEnum::USER_UPDATE);
        $this->create(UserPrivilegeEnum::USER_CANCEL);

        // Course
        $this->create(UserPrivilegeEnum::COURSE_GET, true, true);
        $this->create(UserPrivilegeEnum::COURSE_CREATE);
        $this->create(UserPrivilegeEnum::COURSE_UPDATE);
        $this->create(UserPrivilegeEnum::COURSE_CANCEL);

        // Course
        $this->create(UserPrivilegeEnum::MATERIAL_GET, true, true);
        $this->create(UserPrivilegeEnum::MATERIAL_CREATE);
        $this->create(UserPrivilegeEnum::MATERIAL_UPDATE);
        $this->create(UserPrivilegeEnum::MATERIAL_CANCEL);

        // Course
        $this->create(UserPrivilegeEnum::MODULE_GET, true, true);
        $this->create(UserPrivilegeEnum::MODULE_CREATE);
        $this->create(UserPrivilegeEnum::MODULE_UPDATE);
        $this->create(UserPrivilegeEnum::MODULE_CANCEL);

        // Course
        $this->create(UserPrivilegeEnum::LESSON_GET, true, true);
        $this->create(UserPrivilegeEnum::LESSON_CREATE);
        $this->create(UserPrivilegeEnum::LESSON_UPDATE);
        $this->create(UserPrivilegeEnum::LESSON_CANCEL);

        // Course
        $this->create(UserPrivilegeEnum::QUESTION_GET, true, true);
        $this->create(UserPrivilegeEnum::QUESTION_CREATE);
        $this->create(UserPrivilegeEnum::QUESTION_UPDATE);
        $this->create(UserPrivilegeEnum::QUESTION_CANCEL);

        // Course
        $this->create(UserPrivilegeEnum::TEST_GET, true, true);
        $this->create(UserPrivilegeEnum::TEST_CREATE);
        $this->create(UserPrivilegeEnum::TEST_UPDATE);
        $this->create(UserPrivilegeEnum::TEST_CANCEL);

        // General
        $this->create(UserPrivilegeEnum::CATEGORY_GET, true);
        $this->create(UserPrivilegeEnum::CATEGORY_CREATE, true);
        $this->create(UserPrivilegeEnum::CATEGORY_UPDATE, true);
        $this->create(UserPrivilegeEnum::CATEGORY_DELETE);

        // Mailing
        $this->create(UserPrivilegeEnum::MESSAGE_GET);
        $this->create(UserPrivilegeEnum::MESSAGE_CREATE);
        $this->create(UserPrivilegeEnum::MESSAGE_CANCEL);
        $this->create(UserPrivilegeEnum::MESSAGE_TEMPLATE_GET);
        $this->create(UserPrivilegeEnum::MESSAGE_TEMPLATE_CREATE);
        $this->create(UserPrivilegeEnum::MESSAGE_TEMPLATE_UPDATE);
        $this->create(UserPrivilegeEnum::MESSAGE_TEMPLATE_DELETE);

        // System
        $this->create(UserPrivilegeEnum::BUG_LOG_GET);

        $this->create(UserPrivilegeEnum::PAGES_PEOPLE);
        $this->create(UserPrivilegeEnum::PAGES_CLASSES);
    }

    /**
     * Create the User Privilege entry;
     *
     * @param string $id
     * @param boolean $teacher_can
     * @param boolean $student_can
     * @return void
     */
    protected function create(string $id, bool $teacher_can = false, bool $student_can = false): void
    {
        $userPrivilege = new UserPrivilege(compact('id', 'teacher_can', 'student_can'));
        $userPrivilege->save();
    }
}
