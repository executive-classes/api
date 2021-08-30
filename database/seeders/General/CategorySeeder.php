<?php

namespace Database\Seeders\General;

use App\Models\Eloquent\General\Category\Category;
use Database\Seeders\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the local database seeds.
     *
     * @return void
     */
    protected function local()
    {
        Category::factory(5)->persist()->parent()->create();
    }
}