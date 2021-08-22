<?php

use App\Models\Classroom\Lesson\Lesson;
use App\Models\Classroom\Question\Question;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonXQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_x_question', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Lesson Question ID.');

            // Timestamps
            $table->timestamps();

            // Lesson Question Data
            $table->foreignIdFor(Lesson::class, 'lesson_id')
                ->references('id')
                ->on('lesson')
                ->comment('The lesson.');

            $table->foreignIdFor(Question::class, 'question_id')
                ->references('id')
                ->on('question')
                ->comment('The question.');

            $table->integer('precedence')
                ->default(0)
                ->comment('The question precedence.');
        });

        // Adding columns comments.
        Schema::table('lesson_x_question', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
            ->comment('Lesson Question creation date.')
            ->change();

            $table->timestamp('updated_at')
            ->comment('Lesson Question last update date.')
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
        Schema::dropIfExists('lesson_x_question');
    }
}
