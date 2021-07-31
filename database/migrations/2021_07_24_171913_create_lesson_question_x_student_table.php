<?php

use App\Models\Billing\Student;
use App\Models\Billing\Teacher;
use App\Models\Classroom\Lesson;
use App\Models\Classroom\Question;
use App\Models\Classroom\QuestionStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonQuestionXStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_question_x_student', function (Blueprint $table) {
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
            $table->foreignIdFor(Question::class, 'question_id')
                ->references('id')
                ->on('question')
                ->comment('The question.');

            $table->foreignIdFor(Lesson::class, 'lesson_id')
                ->references('id')
                ->on('lesson')
                ->comment('The lesson.');

            $table->foreignIdFor(Student::class, 'student_id')
                ->references('id')
                ->on('student')
                ->comment('The student.');

            $table->foreignIdFor(Teacher::class, 'teacher_id')
                ->references('id')
                ->on('teacher')
                ->comment('Teacher that graded the question.');

            $table->integer('answer')
                ->nullable()
                ->comment('Question answer.');

            $table->integer('grade')
                ->default(0)
                ->comment('Question grade.');

            $table->foreignIdFor(QuestionStatus::class, 'question_status_id')
                ->references('id')
                ->on('question_status')
                ->comment('Question status.');
        });

        // Adding columns comments.
        Schema::table('lesson_question_x_student', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
                ->comment('Question creation date.')
                ->change();

            $table->timestamp('updated_at')
                ->comment('Question last update date.')
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
        Schema::dropIfExists('lesson_question_x_student');
    }
}
