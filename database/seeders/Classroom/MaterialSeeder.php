<?php

namespace Database\Seeders\Classroom;

use App\Models\Eloquent\Classroom\Material\Material;
use Database\Seeders\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the local database seeds.
     *
     * @return void
     */
    protected function local()
    {
        Material::factory(5)->persist()->create();
    }
}