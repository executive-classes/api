<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_item', function (Blueprint $table) {
            // PK
            $table->id()->comment('Invoice Item ID.');

            // Timestamps
            $table->timestamp('created_at')->nullable()->comment('Invoice item creation date.');
            $table->timestamp('updated_at')->nullable()->comment('Invoice item last update date.');

            // Item data
            $table->unsignedBigInteger('invoice_id')->comment('Invoice of this item.');
            $table->unsignedBigInteger('student_id')->comment('Student of this item.');

            // Foreign Key
            $table->foreign('invoice_id')->references('id')->on('invoice');
            $table->foreign('student_id')->references('id')->on('student');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_item');
    }
}
