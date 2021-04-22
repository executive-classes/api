<?php

namespace Database\Seeders\Billing;

use App\Enums\Billing\EmployeePositionEnum;
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
        // Create a admin
        User::factory()
            ->has(Employee::factory()->developer(), 'employee')
            ->create(['email' => config('test.user.email')]);
    }
}
