<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\Employee;
use App\Models\Billing\EmployeePosition;
use App\Models\Billing\User;
use App\Traits\UsesFaker;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    use UsesFaker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::factory(5)->create();
    }
}