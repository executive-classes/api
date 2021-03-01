<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\Teacher;
use App\Models\Billing\User;
use App\Traits\UsesFaker;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    use UsesFaker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teacher::factory(5)->create();
    }
}