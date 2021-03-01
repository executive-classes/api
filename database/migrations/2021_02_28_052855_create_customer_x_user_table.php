<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerXUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_x_user', function (Blueprint $table) {
            // PK
            $table->unsignedBigInteger('customer_id')->comment('Customer ID.');
            $table->unsignedBigInteger('user_id')->comment('User ID.');
            $table->primary(['customer_id', 'user_id']);

            // Foreign key
            $table->foreign('customer_id')->references('id')->on('customer');
            $table->foreign('user_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_x_user');
    }
}
