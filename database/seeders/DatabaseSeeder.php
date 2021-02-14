<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            \Database\Seeders\Billing\TaxTypeSeeder::class,
            \Database\Seeders\Billing\UserPrivilegeSeeder::class,
            \Database\Seeders\Billing\UserRoleSeeder::class,
            \Database\Seeders\Billing\UserSeeder::class
        ]);
    }
}
