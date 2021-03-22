<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            // PK
            $table->id()->comment('Invoice ID.');

            // Timestamps
            $table->timestamp('created_at')->nullable()->comment('Invoice creation date.');
            $table->timestamp('updated_at')->nullable()->comment('Invoice last update date.');

            // Collection Data
            $table->unsignedBigInteger('collection_id')->comment('Collection of this invoice.');
            $table->longText('xml')->nullable()->comment('The invoice XML.');
            $table->longText('receipt')->nullable()->comment('The sent invoice receipt.');
            $table->longText('error_message')->nullable()->comment('The error in the processing of the invoice.');

            // Foreign Key
            $table->foreign('collection_id')->references('id')->on('collection');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice');
    }
}
