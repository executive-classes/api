<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_status', function (Blueprint $table) {
            // PK
            $table->string('id')
                ->comment('Message status id.');

            $table->primary('id');

            // Message status data
            $table->string('description')
                ->comment('Message status description.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message_status');
    }
}
