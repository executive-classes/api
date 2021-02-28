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
        $this->create('*', 'Can do all things.');

        // Auth
        $this->create('auth:cross', 'Can cross-auth in others users.');

        // Mailing
        $this->create('message:get', 'Can get or list messages.');
        $this->create('message:create', 'Can create new messages.');
        $this->create('message:cancel', 'Can cancel scheduled messages.');
        $this->create('message:delete', 'Can delete messages.');
        $this->create('message_template:get', 'Can get or list messages templates.');
        $this->create('message_template:create', 'Can create messages templates.');
        $this->create('message_template:update', 'Can update messages templates.');
        $this->create('message_template:delete', 'Can delete messages templates.');
    }

    /**
     * Create the User Privilege entry;
     *
     * @param string $id
     * @param string $name
     * @return void
     */
    protected function create(string $id, string $description): void
    {
        $userRole = new UserPrivilege(compact('id', 'description'));
        $userRole->save();
    }
}
