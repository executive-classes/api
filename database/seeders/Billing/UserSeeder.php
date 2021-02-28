<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\SystemLanguage;
use App\Models\Billing\User;
use App\Models\Billing\TaxType;
use Illuminate\Database\Seeder;
use App\Models\Billing\UserRole;
use App\Traits\UsesFaker;

class UserSeeder extends Seeder
{
    use UsesFaker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a admin
        User::factory()
            ->for(TaxType::find('cpf'), 'taxType')
            ->for($this->faker()->randomElement(SystemLanguage::all()), 'language')
            ->hasAttached(UserRole::find(UserRole::ADMIN), [], 'roles')
            ->afterCreating(function ($message) {
                $message->email = 'ronaldo.stiene@executiveclasses.com.br';
                $message->save();
            })
            ->create();

        // Create three random users
        User::factory(3)
            ->for(TaxType::find('cpf'), 'taxType')
            ->for($this->faker()->randomElement(SystemLanguage::all()), 'language')
            ->hasAttached($this->faker()->randomElement(UserRole::all()), [], 'roles')
            ->create();
    }
}
