<?php

namespace Database\Seeders\Billing;

use App\Models\Eloquent\Billing\Student\Student;
use Database\Seeders\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the local database seeds.
     *
     * @return void
     */
    protected function local()
    {
        // Creating student for every status
        Student::factory()->persist()->active()->create();
        Student::factory()->persist()->suspended()->create();
        Student::factory()->persist()->canceled()->create();
    }
}
