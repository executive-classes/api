<?php

use App\Models\Billing\Student;
use App\Models\Classroom\Course;
use App\Models\Classroom\CourseStatus;
use App\Models\Classroom\Test;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseXStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_x_student', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Course ID.');

            // Timestamps
            $table->timestamps();

            $table->timestamp('start_at')
                ->nullable()
                ->comment('Course start date.');

            $table->timestamp('finish_at')
                ->nullable()
                ->comment('Course finish date.');

            // Course Data
            $table->foreignIdFor(Course::class, 'course_id')
                ->references('id')
                ->on('course')
                ->comment('The course.');

            $table->foreignIdFor(Student::class, 'student_id')
                ->references('id')
                ->on('student')
                ->comment('Student that made the course.');
            
            $table->foreignIdFor(CourseStatus::class, 'course_status_id')
                ->references('id')
                ->on('course_status')
                ->comment('Course status.');
            
            $table->foreignIdFor(Test::class, 'test_id')
                ->references('id')
                ->on('test')
                ->comment('Course final test.');
        });

        // Adding columns comments.
        Schema::table('course_x_student', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
            ->comment('Course creation date.')
            ->change();

            $table->timestamp('updated_at')
            ->comment('Course last update date.')
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
        Schema::dropIfExists('course_x_student');
    }
}
