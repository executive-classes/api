<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentIntervalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_interval', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Payment Interval id.');

            // Message status data
            $table->string('name')
                ->comment('Payment Interval name.');

            $table->string('description')
                ->comment('Payment Interval description.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_interval');
    }
}
