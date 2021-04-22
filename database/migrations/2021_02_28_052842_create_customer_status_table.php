<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_status', function (Blueprint $table) {
            // PK
            $table->string('id')
                ->comment('Customer status id.');
                
            $table->primary('id');

            // Message status data
            $table->string('name')
                ->comment('Customer status name.');

            $table->string('description')
                ->comment('Customer status description.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_status');
    }
}
