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
             * General Models Seeders
             */

            \Database\Seeders\General\CategoryTypeSeeder::class,

            /**
             * System Models Seeders
             */

            \Database\Seeders\System\SystemAppSeeder::class,
            \Database\Seeders\System\SystemLanguageSeeder::class,

            /**
             * Billing Models Seeders
             */
            \Database\Seeders\Billing\AddressCountrySeeder::class,
            \Database\Seeders\Billing\AddressStateSeeder::class,
            \Database\Seeders\Billing\AddressCitySeeder::class,
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
             * Classroom Models Seeders
             */

            \Database\Seeders\Classroom\TestStatusSeeder::class,
            \Database\Seeders\Classroom\CourseStatusSeeder::class,
            \Database\Seeders\Classroom\ModuleStatusSeeder::class,
            \Database\Seeders\Classroom\LessonStatusSeeder::class,
            \Database\Seeders\Classroom\QuestionStatusSeeder::class,
            \Database\Seeders\Classroom\MaterialStatusSeeder::class,

            /**
             * Mailing Models Seeders
             */
            \Database\Seeders\Mailing\MessageStatusSeeder::class,
            \Database\Seeders\Mailing\MessageTypeSeeder::class,

        ]);
    }
}
