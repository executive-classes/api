<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\Collection;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Collection::factory(20)->create();
    }
}