<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_method', function (Blueprint $table) {
            // PK
            $table->string('id')
                ->comment('Payment Method id.');

            $table->primary('id');

            // Message status data
            $table->string('name')
                ->comment('Payment Method name.');

            $table->string('description')
                ->comment('Payment Method description.');

            $table->string('invoice_code')
                ->comment('Code of the payment method in the brazillian invoice.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_method');
    }
}
