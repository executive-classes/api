<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_card', function (Blueprint $table) {
            // PK
            $table->id()->comment('Credit card ID.');

            // Credit Card data
            $table->string('type')->comment('Credit card expiration year.');
            $table->string('name')->comment('Credit card name.');
            $table->unsignedBigInteger('number')->unique()->comment('Credit card number.');
            $table->string('expiration_date', 5)->comment('Credit card expiration date (mm/yy).');
            $table->unsignedSmallInteger('security')->comment('Credit card security code.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credit_card');
    }
}
