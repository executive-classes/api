<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemAppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_app', function (Blueprint $table) {
            // PK
            $table->string('id')
                ->comment('System App Id.');

            $table->primary('id');

            // Data
            $table->string('name')
                ->comment('The name of the application.');

            $table->boolean('active')
                ->comment('The status of the application.');

            $table->ipAddress('ip')
                ->comment('The IP of the application.');
            
            $table->string('url')
                ->comment('The URL of the application.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_app');
    }
}
