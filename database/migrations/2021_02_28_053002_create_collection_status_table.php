<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_status', function (Blueprint $table) {
            // PK
            $table->string('id')
                ->comment('Collection status id.');

            $table->primary('id');

            // Message status data
            $table->string('name')
                ->comment('Collection status name.');

            $table->string('description')
                ->comment('Collection status description.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collection_status');
    }
}
