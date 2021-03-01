<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\Employee;
use App\Models\Billing\EmployeePosition;
use App\Models\Billing\SystemLanguage;
use App\Models\Billing\User;
use App\Models\Billing\UserPrivilege;
use Illuminate\Database\Seeder;
use App\Traits\UsesFaker;

class UserSeeder extends Seeder
{
    use UsesFaker;

    public const TEST_EMAIL = 'ronaldo.stiene@executiveclasses.com.br';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a admin
        User::factory()
            ->for($this->faker()->randomElement(SystemLanguage::all()), 'language')
            ->afterCreating(function ($user) {
                $user->email = self::TEST_EMAIL;
                $user->save();
                $employee = new Employee([
                    'user_id' => $user->id,
                    'employee_position_id' => EmployeePosition::DEVELOPER
                ]);
                $employee->save();
            })
            ->create();

        // Create random users
        User::factory(19)
            ->for($this->faker()->randomElement(SystemLanguage::all()), 'language')
            ->create();
    }
}
