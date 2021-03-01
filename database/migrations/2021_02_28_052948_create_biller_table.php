<?php

use App\Models\Billing\BillerStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biller', function (Blueprint $table) {
            // PK
            $table->id()->comment('Biller ID.');

            // Timestamps
            $table->timestamp('created_at')->nullable()->comment('Biller creation date.');
            $table->timestamp('updated_at')->nullable()->comment('Biller last update date.');
            $table->timestamp('inactive_at')->nullable()->comment('Biller inactivate date.');
            $table->timestamp('reactive_at')->nullable()->comment('Biller reactivate date.');

            // Biller Data
            $table->unsignedBigInteger('customer_id')->comment('Customer that have this biller.');
            $table->string('biller_status_id')->default(BillerStatus::ACTIVE)->comment('Determine the status of the biller.');
            $table->string('name')->comment('Biller name.');
            $table->string('tax_type_id')->comment('Biller tax type.');
            $table->string('tax_code')->unique()->comment('Biller tax code.');

            // Biller contact data
            $table->unsignedBigInteger('building_id')->comment('Determine the building of the biller.');
            $table->string('email')->nullable()->comment('The contact e-mail for the biller.');
            $table->string('phone')->nullable()->comment('The contact phone for the biller.');
            $table->string('phone_alt')->nullable()->comment('A second contact phone for the biller.');

            // Biller payment data
            $table->unsignedTinyInteger('payment_interval_id')->comment('Payment interval of this biller.');
            $table->string('payment_method_id')->comment('Payment method of this biller.');
            $table->unsignedBigInteger('credit_card_id')->nullable()->comment('Credit card that pays this biller.');
            $table->unsignedBigInteger('bank_id')->nullable()->comment('Bank that receives the payment for this biller.');

            // Foreign Key
            $table->foreign('customer_id')->references('id')->on('customer');
            $table->foreign('tax_type_id')->references('id')->on('tax_type');
            $table->foreign('biller_status_id')->references('id')->on('customer_status');
            $table->foreign('building_id')->references('id')->on('building');
            $table->foreign('payment_interval_id')->references('id')->on('payment_interval');
            $table->foreign('payment_method_id')->references('id')->on('payment_method');
            $table->foreign('credit_card_id')->references('id')->on('credit_card');
            $table->foreign('bank_id')->references('id')->on('bank');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biller');
    }
}
