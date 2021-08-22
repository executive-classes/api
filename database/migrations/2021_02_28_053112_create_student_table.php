<?php

use App\Enums\Billing\StudentStatusEnum;
use App\Models\Billing\Biller\Biller;
use App\Models\Billing\Customer\Customer;
use App\Models\Billing\StudentStatus\StudentStatus;
use App\Models\Billing\User\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Student ID.');

            // Timestamps
            $table->timestamps();

            // Collection Data
            $table->foreignIdFor(Customer::class, 'customer_id')
                ->references('id')
                ->on('customer')
                ->comment('Customer of this student.');

            $table->foreignIdFor(Biller::class, 'biller_id')
                ->references('id')
                ->on('biller')
                ->comment('Biller of this student.');

            $table->foreignIdFor(User::class, 'user_id')
                ->unique()
                ->references('id')
                ->on('user')
                ->comment('User of this student.');

            $table->foreignIdFor(StudentStatus::class, 'student_status_id')
                ->default(StudentStatusEnum::ACTIVE)
                ->references('id')
                ->on('student_status')
                ->comment('Status of the student.');
        });

        // Adding columns comments.
        Schema::table('student', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
                ->comment('Student creation date.')
                ->change();
                
            $table->timestamp('updated_at')
                ->comment('Student last update date.')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student');
    }
}
