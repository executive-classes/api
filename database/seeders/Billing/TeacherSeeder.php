<?php

namespace Database\Seeders\Billing;

use App\Models\Eloquent\Billing\Teacher\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teacher::factory()->create();
    }
}