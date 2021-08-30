<?php

namespace Database\Seeders\Classroom;

use App\Models\Eloquent\Classroom\Test\Test;
use Database\Seeders\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the local database seeds.
     *
     * @return void
     */
    protected function local()
    {
        Test::factory(5)->persist()->create();
    }
}