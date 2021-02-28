<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPrivilegeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_privilege', function (Blueprint $table) {
            // PK
            $table->string('id')->comment('Privilege id.');
            $table->primary('id');
            
            // Privilege Data
            $table->string('description')->comment('Privilage description.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_privileges');
    }
}
