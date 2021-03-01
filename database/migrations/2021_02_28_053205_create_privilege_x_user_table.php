<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivilegeXUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privilege_x_user', function (Blueprint $table) {
            // PK
            $table->unsignedBigInteger('user_id')->comment('User ID.');
            $table->string('user_privilege_id')->comment('Privilege ID.');
            $table->primary(['user_id', 'user_privilege_id']);

            // Foreign key
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('user_privilege_id')->references('id')->on('user_privilege');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('privilege_x_user');
    }
}
