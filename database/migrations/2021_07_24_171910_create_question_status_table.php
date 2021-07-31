<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_status', function (Blueprint $table) {
            // PK
            $table->string('id')
                ->comment('Question status id.');

            $table->primary('id');

            // Question status data
            $table->string('name')
                ->comment('Question status name.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_status');
    }
}
