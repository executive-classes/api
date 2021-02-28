<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\UserRole;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create('admin', 'Administrador', [
            '*'
        ]);

        $this->create('finan', 'Financeiro', [
            'message:get',
            'message:create',
            'message_template:get',
        ]);

        $this->create('tech', 'Técnico', [
            'auth:cross',
            'message:get',
            'message:create',
            'message_template:get',
            'message_template:create',
            'message_template:update',
            'message_template:delete',
        ]);

    }

    /**
     * Create the User Role entry;
     *
     * @param string $id
     * @param string $name
     * @return void
     */
    protected function create(string $id, string $name, array $privileges = []): void
    {
        $userRole = new UserRole(compact('id', 'name'));
        $userRole->save();
        $userRole->privileges()->toggle($privileges);
    }
}
