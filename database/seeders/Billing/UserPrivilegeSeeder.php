<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\UserPrivilege;
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
        $this->create(UserPrivilege::ALL, 'Can do all things.');

        // Auth
        $this->create(UserPrivilege::CROSS_AUTH, 'Can cross-auth in others users.');

        // Mailing
        $this->create(UserPrivilege::MESSAGE_GET, 'Can get or list messages.');
        $this->create(UserPrivilege::MESSAGE_CREATE, 'Can create new messages.');
        $this->create(UserPrivilege::MESSAGE_CANCEL, 'Can cancel scheduled messages.');
        $this->create(UserPrivilege::MESSAGE_DELETE, 'Can delete messages.');
        $this->create(UserPrivilege::MESSAGE_TEMPLATE_GET, 'Can get or list messages templates.');
        $this->create(UserPrivilege::MESSAGE_TEMPLATE_CREATE, 'Can create messages templates.');
        $this->create(UserPrivilege::MESSAGE_TEMPLATE_UPDATE, 'Can update messages templates.');
        $this->create(UserPrivilege::MESSAGE_TEMPLATE_DELETE, 'Can delete messages templates.');
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
