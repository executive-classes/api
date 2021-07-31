<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_status', function (Blueprint $table) {
            // PK
            $table->string('id')
                ->comment('Test status id.');

            $table->primary('id');

            // Test status data
            $table->string('name')
                ->comment('Test status name.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_status');
    }
}
