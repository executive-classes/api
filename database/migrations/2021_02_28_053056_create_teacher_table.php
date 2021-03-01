<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher', function (Blueprint $table) {
            // PK
            $table->id()->comment('Teacher ID.');

            // Timestamps
            $table->timestamp('created_at')->nullable()->comment('Teacher creation date.');
            $table->timestamp('updated_at')->nullable()->comment('Teacher last update date.');

            // Collection Data
            $table->unsignedBigInteger('user_id')->unique()->comment('User of this teacher.');

            // Foreign Key
            $table->foreign('user_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher');
    }
}
