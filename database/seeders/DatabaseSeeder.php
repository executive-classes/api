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
            \Database\Seeders\Billing\SystemLanguageSeeder::class,
            \Database\Seeders\Billing\TaxTypeSeeder::class,
            \Database\Seeders\Billing\UserPrivilegeSeeder::class,
            \Database\Seeders\Billing\EmployeePositionSeeder::class,
            \Database\Seeders\Billing\UserSeeder::class,
            \Database\Seeders\Billing\BuildingSeeder::class,
            \Database\Seeders\Billing\CustomerStatusSeeder::class,
            \Database\Seeders\Billing\CustomerSeeder::class,
            \Database\Seeders\Billing\PaymentMethodSeeder::class,
            \Database\Seeders\Billing\PaymentIntervalSeeder::class,
            \Database\Seeders\Billing\CreditCardSeeder::class,
            \Database\Seeders\Billing\BankSeeder::class,
            \Database\Seeders\Billing\BillerStatusSeeder::class,
            \Database\Seeders\Billing\BillerSeeder::class,
            \Database\Seeders\Billing\CollectionStatusSeeder::class,
            \Database\Seeders\Billing\CollectionSeeder::class,
            \Database\Seeders\Billing\InvoiceStatusSeeder::class,
            \Database\Seeders\Billing\InvoiceSeeder::class,
            \Database\Seeders\Billing\TeacherStatusSeeder::class,
            \Database\Seeders\Billing\TeacherSeeder::class,
            \Database\Seeders\Billing\StudentStatusSeeder::class,
            \Database\Seeders\Billing\StudentSeeder::class,
            \Database\Seeders\Billing\EmployeeStatusSeeder::class,
            \Database\Seeders\Billing\EmployeeSeeder::class,
            \Database\Seeders\Billing\CollectionItemSeeder::class,
            \Database\Seeders\Billing\InvoiceItemSeeder::class,

            /**
             * Mailing Models Seeders
             */
            \Database\Seeders\Mailing\MessageFooterSeeder::class,
            \Database\Seeders\Mailing\MessageHeaderSeeder::class,
            \Database\Seeders\Mailing\MessageStatusSeeder::class,
            \Database\Seeders\Mailing\MessageTypeSeeder::class,
            \Database\Seeders\Mailing\MessageTemplateSeeder::class,
            \Database\Seeders\Mailing\MessageSeeder::class,

        ]);
    }
}
