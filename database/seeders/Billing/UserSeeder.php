<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\User;
use App\Models\Billing\TaxType;
use Illuminate\Database\Seeder;
use App\Models\Billing\UserRole;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(2)
            ->for(TaxType::find('cpf'), 'taxType')
            ->hasAttached(UserRole::all(), [], 'roles')
            ->create();
    }
}
