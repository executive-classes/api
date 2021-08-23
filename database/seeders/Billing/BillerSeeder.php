<?php

namespace Database\Seeders\Billing;

use App\Models\Eloquent\Billing\Biller\Biller;
use Illuminate\Database\Seeder;

class BillerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Biller::factory()->create();
    }
}