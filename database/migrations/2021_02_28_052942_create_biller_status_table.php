<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillerStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biller_status', function (Blueprint $table) {
            // PK
            $table->string('id')->comment('Biller status id.');
            $table->primary('id');

            // Message status data
            $table->string('name')->comment('Biller status name.');
            $table->string('description')->comment('Biller status description.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biller_status');
    }
}
