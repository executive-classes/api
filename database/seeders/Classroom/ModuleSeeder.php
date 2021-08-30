<?php

namespace Database\Seeders\Classroom;

use App\Models\Eloquent\Classroom\Module\Module;
use Database\Seeders\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the local database seeds.
     *
     * @return void
     */
    protected function local()
    {
        // Creates a module with a course
        Module::factory()->persist()->course()->create();
        
        // Creates a module without a course
        Module::factory()->persist()->create();
    }
}