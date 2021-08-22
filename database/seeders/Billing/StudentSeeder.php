<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\Student\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::factory()->create();
    }
}
