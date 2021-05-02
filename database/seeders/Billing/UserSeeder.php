<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\Employee;
use App\Models\Billing\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a develop
        User::factory()
            ->has(Employee::factory()->developer(), 'employee')
            ->create(['email' => config('test.user.emails.dev')]);

        // Create a admin
        User::factory()
            ->has(Employee::factory()->administrator(), 'employee')
            ->create(['email' => config('test.user.emails.adm')]);

        // Create a financial
        // User::factory()
        //     ->has(Employee::factory()->financial(), 'employee')
        //     ->create(['email' => config('test.user.emails.fin')]);
    }
}
