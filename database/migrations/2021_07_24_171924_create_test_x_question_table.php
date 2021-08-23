<?php

use App\Models\Eloquent\Classroom\Question\Question;
use App\Models\Eloquent\Classroom\Test\Test;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestXQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_x_question', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Test Question ID.');

            // Timestamps
            $table->timestamps();

            // Test Question Data
            $table->foreignIdFor(Test::class, 'test_id')
                ->references('id')
                ->on('test')
                ->comment('The test.');

            $table->foreignIdFor(Question::class, 'question_id')
                ->references('id')
                ->on('question')
                ->comment('The question.');

            $table->integer('precedence')
                ->default(0)
                ->comment('The question precedence.');
        });

        // Adding columns comments.
        Schema::table('test_x_question', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
            ->comment('Test Question creation date.')
            ->change();

            $table->timestamp('updated_at')
            ->comment('Test Question last update date.')
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
        Schema::dropIfExists('test_x_question');
    }
}
