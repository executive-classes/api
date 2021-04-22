<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_status', function (Blueprint $table) {
            // PK
            $table->string('id')
                ->comment('Student status id.');

            $table->primary('id');

            // Message status data
            $table->string('name')
                ->comment('Student status name.');

            $table->string('description')
                ->comment('Student status description.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_status');
    }
}
