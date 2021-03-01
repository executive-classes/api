<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_status', function (Blueprint $table) {
            // PK
            $table->string('id')->comment('Teacher status id.');
            $table->primary('id');

            // Message status data
            $table->string('name')->comment('Teacher status name.');
            $table->string('description')->comment('Teacher status description.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_status');
    }
}
