<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeePositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_position', function (Blueprint $table) {
            // PK
            $table->string('id')->comment('Employee position ID.');
            $table->primary('id');

            // Message status data
            $table->string('name')->comment('Position name.');
            $table->string('parent_id')->nullable()->comment('Position parent.');

            // Foreign Key
            $table->foreign('parent_id')->references('id')->on('employee_position');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_position');
    }
}
