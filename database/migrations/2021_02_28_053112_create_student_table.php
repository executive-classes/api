<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            // PK
            $table->id()->comment('Student ID.');

            // Timestamps
            $table->timestamp('created_at')->nullable()->comment('Student creation date.');
            $table->timestamp('updated_at')->nullable()->comment('Student last update date.');

            // Collection Data
            $table->unsignedBigInteger('customer_id')->comment('Customer of this student.');
            $table->unsignedBigInteger('biller_id')->comment('Biller of this student.');
            $table->unsignedBigInteger('user_id')->unique()->comment('User of this student.');

            // Foreign Key
            $table->foreign('customer_id')->references('id')->on('customer');
            $table->foreign('biller_id')->references('id')->on('biller');
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
        Schema::dropIfExists('student');
    }
}
