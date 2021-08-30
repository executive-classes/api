<?php

namespace Database\Seeders\Billing;

use App\Models\Eloquent\Billing\Teacher\Teacher;
use Database\Seeders\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the local database seeds.
     *
     * @return void
     */
    protected function local()
    {
        // Creating teacher for every status
        Teacher::factory()->persist()->active()->create();
        Teacher::factory()->persist()->suspended()->create();
        Teacher::factory()->persist()->canceled()->create();
    }
}