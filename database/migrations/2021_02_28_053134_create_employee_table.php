<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            // PK
            $table->id()->comment('Employee ID.');

            // Timestamps
            $table->timestamp('created_at')->nullable()->comment('Employee creation date.');
            $table->timestamp('updated_at')->nullable()->comment('Employee last update date.');

            // Collection Data
            $table->string('employee_position_id')->comment('The position of this employee.');
            $table->unsignedBigInteger('user_id')->unique()->comment('User of this employee.');

            // Foreign Key
            $table->foreign('employee_position_id')->references('id')->on('employee_position');
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
        Schema::dropIfExists('employee');
    }
}
