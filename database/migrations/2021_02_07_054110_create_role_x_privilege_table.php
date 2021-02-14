<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleXPrivilegeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_x_privilege', function (Blueprint $table) {
            $table->string('user_role_id')->comment('Role ID.');
            $table->string('user_privilege_id')->comment('Privilege ID.');

            $table->primary(['user_role_id', 'user_privilege_id']);

            $table->foreign('user_role_id')->references('id')->on('user_role');
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
        Schema::dropIfExists('role_x_privilege');
    }
}
