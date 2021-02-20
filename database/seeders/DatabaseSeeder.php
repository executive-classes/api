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

            /**
             * Billing Models Seeders
             */
            \Database\Seeders\Billing\TaxTypeSeeder::class,
            \Database\Seeders\Billing\UserPrivilegeSeeder::class,
            \Database\Seeders\Billing\UserRoleSeeder::class,
            \Database\Seeders\Billing\UserSeeder::class,

            /**
             * Mailing Models Seeders
             */
            \Database\Seeders\Mailing\MessageFooterSeeder::class,
            \Database\Seeders\Mailing\MessageHeaderSeeder::class,
            \Database\Seeders\Mailing\MessageStatusSeeder::class,
            \Database\Seeders\Mailing\MessageTypeSeeder::class,
            \Database\Seeders\Mailing\MessageTemplateSeeder::class,

        ]);
    }
}
