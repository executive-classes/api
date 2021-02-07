<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserXRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_x_role', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('user_role_id');

            $table->primary(['user_id', 'user_role_id']);

            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('user_role_id')->references('id')->on('user_role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_x_role');
    }
}
