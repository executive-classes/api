<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bank::factory(10)->create();
    }
}