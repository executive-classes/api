<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivilegeXPositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privilege_x_position', function (Blueprint $table) {
            // PK
            $table->string('position_id')->comment('Position ID.');
            $table->string('privilege_id')->comment('Privilege ID.');
            $table->primary(['position_id', 'privilege_id']);

            // Foreign key
            $table->foreign('position_id')->references('id')->on('employee_position');
            $table->foreign('privilege_id')->references('id')->on('user_privilege');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('privilege_x_position');
    }
}
