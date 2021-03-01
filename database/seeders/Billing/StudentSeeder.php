<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\Student;
use App\Models\Billing\User;
use App\Traits\UsesFaker;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    use UsesFaker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::factory(5)->create();
    }
}
