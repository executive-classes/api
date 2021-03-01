<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\Building;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Building::factory(5)
            ->create();
    }
}
