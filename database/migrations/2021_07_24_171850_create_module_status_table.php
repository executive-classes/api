<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_status', function (Blueprint $table) {
            // PK
            $table->string('id')
                ->comment('Course status id.');

            $table->primary('id');

            // Course status data
            $table->string('name')
                ->comment('Course status name.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_status');
    }
}
