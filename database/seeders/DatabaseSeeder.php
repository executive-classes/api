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
        $this->call(array_merge(
            $this->getDefaultSeeders(),
            isLocal() ? $this->getLocalSeeders() : [],
            isTest() ? $this->getTestSeeders() : []
        ));
    }

    /**
     * Get the default seeders classes.
     *
     * @return array
     */
    private function getDefaultSeeders(): array 
    {
        return [

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

        ];
    }

    /**
     * Return the local seeders classes.
     *
     * @return array
     */
    private function getLocalSeeders(): array
    {
        return [

            /**
             * General Models Seeders
             */
            \Database\Seeders\General\CategorySeeder::class,

            /**
             * Billing Models Seeders
             */
            \Database\Seeders\Billing\AddressSeeder::class,
            \Database\Seeders\Billing\BillerSeeder::class,
            \Database\Seeders\Billing\CollectionSeeder::class,
            \Database\Seeders\Billing\CollectionItemSeeder::class,
            \Database\Seeders\Billing\CustomerSeeder::class,
            \Database\Seeders\Billing\EmployeeSeeder::class,
            \Database\Seeders\Billing\InvoiceSeeder::class,
            \Database\Seeders\Billing\InvoiceItemSeeder::class,
            \Database\Seeders\Billing\StudentSeeder::class,
            \Database\Seeders\Billing\TeacherSeeder::class,
            \Database\Seeders\Billing\UserSeeder::class,

            /**
             * Classroom Models Seeders
             */
            \Database\Seeders\Classroom\CourseSeeder::class,
            \Database\Seeders\Classroom\ModuleSeeder::class,
            \Database\Seeders\Classroom\LessonSeeder::class,
            \Database\Seeders\Classroom\TestSeeder::class,
            \Database\Seeders\Classroom\QuestionSeeder::class,
            \Database\Seeders\Classroom\MaterialSeeder::class,


            /**
             * Mailing Models Seeders
             */
            \Database\Seeders\Mailing\MessageFooterSeeder::class,
            \Database\Seeders\Mailing\MessageHeaderSeeder::class,
            \Database\Seeders\Mailing\MessageSeeder::class,
            \Database\Seeders\Mailing\MessageTemplateSeeder::class,
            
        ];
    }

    /**
     * Return the test seeders classes.
     *
     * @return array
     */
    private function getTestSeeders(): array
    {
        return [

            /**
             * Billing Models Seeders
             */
            \Database\Seeders\Billing\UserSeeder::class,

        ];
    }
}
