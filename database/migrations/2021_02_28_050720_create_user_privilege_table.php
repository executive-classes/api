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
            $table->string('id')
                ->comment('Privilege id.');
                
            $table->primary('id');
            
            // Privilege Data
            $table->boolean('teacher_can')
                ->default(false)
                ->comment('Determine if the teachers has this privilege');

            $table->boolean('student_can')
                ->default(false)
                ->comment('Determine if the students has this privilege');
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
