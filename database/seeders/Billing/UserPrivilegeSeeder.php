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
        $this->create('internal', 'Can access the internal services.');
        $this->create('portal', 'Can access the portal services.');
        $this->create('cross_auth', 'Can cross-auth in others users.');
        $this->create('telescope', 'Can use admin tools in the system.');
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
