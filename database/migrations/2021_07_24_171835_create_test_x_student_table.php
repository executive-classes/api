<?php

use App\Models\Billing\Student;
use App\Models\Billing\Teacher;
use App\Models\Classroom\Test;
use App\Models\Classroom\TestStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestXStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_x_student', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Test ID.');

            // Timestamps
            $table->timestamps();

            $table->timestamp('start_at')
                ->nullable()
                ->comment('Test start date.');

            $table->timestamp('finish_at')
                ->nullable()
                ->comment('Test finish date.');

            $table->timestamp('grade_at')
                ->nullable()
                ->comment('Test grade date.');
            

            // Test Data
            $table->foreignIdFor(Test::class, 'test_id')
                ->references('id')
                ->on('test')
                ->comment('The test.');

            $table->foreignIdFor(Student::class, 'student_id')
                ->references('id')
                ->on('student')
                ->comment('Student that made the test.');

            $table->foreignIdFor(Teacher::class, 'teacher_id')
                ->references('id')
                ->on('teacher')
                ->comment('Teacher that graded the test.');
            
            $table->integer('time')
                ->comment('Test limit time (minutes).');
            
            $table->integer('grade')
                ->default(0)
                ->comment('Test grade.');

            $table->foreignIdFor(TestStatus::class, 'test_status_id')
                ->references('id')
                ->on('test_status')
                ->comment('Test status.');
        });

        // Adding columns comments.
        Schema::table('test_x_student', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
            ->comment('Test creation date.')
            ->change();

            $table->timestamp('updated_at')
            ->comment('Test last update date.')
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
        Schema::dropIfExists('test_x_student');
    }
}
