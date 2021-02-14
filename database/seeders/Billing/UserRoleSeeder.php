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
        $this->create('adm', 'Administrador', [
            'cross_auth',
            'internal'
        ]);

        $this->create('fin', 'Financeiro', [
            'internal'
        ]);

        $this->create('tec', 'Técnico', [
            'cross_auth',
            'internal',
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
