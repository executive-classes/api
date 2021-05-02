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
             * System Models Seeders
             */

            \Database\Seeders\System\SystemAppSeeder::class,
            \Database\Seeders\System\SystemLanguageSeeder::class,

            /**
             * Billing Models Seeders
             */
            \Database\Seeders\Billing\TaxTypeSeeder::class,
            \Database\Seeders\Billing\UserPrivilegeSeeder::class,
            \Database\Seeders\Billing\EmployeePositionSeeder::class,
            \Database\Seeders\Billing\CustomerStatusSeeder::class,
            \Database\Seeders\Billing\PaymentMethodSeeder::class,
            \Database\Seeders\Billing\PaymentIntervalSeeder::class,
            \Database\Seeders\Billing\BillerStatusSeeder::class,
            \Database\Seeders\Billing\CollectionStatusSeeder::class,
            \Database\Seeders\Billing\InvoiceStatusSeeder::class,
            \Database\Seeders\Billing\TeacherStatusSeeder::class,
            \Database\Seeders\Billing\StudentStatusSeeder::class,
            \Database\Seeders\Billing\EmployeeStatusSeeder::class,
            \Database\Seeders\Billing\UserSeeder::class,

            /**
             * Mailing Models Seeders
             */
            \Database\Seeders\Mailing\MessageStatusSeeder::class,
            \Database\Seeders\Mailing\MessageTypeSeeder::class,

        ]);
    }
}
