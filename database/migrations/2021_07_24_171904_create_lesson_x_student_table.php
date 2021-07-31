<?php

use App\Models\Billing\Student;
use App\Models\Classroom\Course;
use App\Models\Classroom\LessonStatus;
use App\Models\Classroom\Module;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonXStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_x_student', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Lesson ID.');

            // Timestamps
            $table->timestamps();

            $table->timestamp('start_at')
            ->nullable()
                ->comment('Lesson start date.');

            $table->timestamp('finish_at')
            ->nullable()
                ->comment('Lesson finish date.');

            // Lesson Data
            $table->foreignIdFor(Course::class, 'course_id')
                ->nullable()
                ->references('id')
                ->on('course')
                ->comment('The course.');

            $table->foreignIdFor(Module::class, 'module_id')
                ->nullable()
                ->references('id')
                ->on('module')
                ->comment('The module.');

            $table->foreignIdFor(Student::class, 'student_id')
                ->references('id')
                ->on('student')
                ->comment('The student.');

            $table->foreignIdFor(LessonStatus::class, 'lesson_status_id')
                ->references('id')
                ->on('lesson_status')
                ->comment('Lesson status.');
        });

        // Adding columns comments.
        Schema::table('lesson_x_student', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
            ->comment('Lesson creation date.')
            ->change();

            $table->timestamp('updated_at')
            ->comment('Lesson last update date.')
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
        Schema::dropIfExists('lesson_x_student');
    }
}
