<?php

namespace Database\Seeders\Billing;

use App\Models\Eloquent\Billing\Employee\Employee;
use Database\Seeders\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the local database seeds.
     *
     * @return void
     */
    protected function local()
    {
        // Creating employee for every status
        Employee::factory()->persist()->active()->create();
        Employee::factory()->persist()->suspended()->create();
        Employee::factory()->persist()->canceled()->create();

        // Creating employee for every position
        Employee::factory()->persist()->administrator()->create();
        Employee::factory()->persist()->developer()->create();
        Employee::factory()->persist()->financial()->create();
        Employee::factory()->persist()->technician()->create();
        Employee::factory()->persist()->hr()->create();
    }
}