<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\Employee\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::factory()->create();
    }
}