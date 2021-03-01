<?php

use App\Models\Billing\CustomerStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            // PK
            $table->id()->comment('Customer ID.');

            // Timestamps
            $table->timestamp('created_at')->nullable()->comment('Customer creation date.');
            $table->timestamp('updated_at')->nullable()->comment('Customer last update date.');
            $table->timestamp('inactive_at')->nullable()->comment('Customer inactivate date.');
            $table->timestamp('reactive_at')->nullable()->comment('Customer reactivate date.');

            // Customer Data
            $table->string('customer_status_id')->default(CustomerStatus::ACTIVE)->comment('Determine the status of the customer.');
            $table->string('name')->comment('Customer name.');
            $table->string('tax_type_id')->comment('Customer tax type.');
            $table->string('tax_code')->unique()->comment('Customer tax code.');

            // Customer contact data
            $table->unsignedBigInteger('building_id')->comment('Determine the building of the customer.');
            $table->string('email')->nullable()->comment('The contact e-mail for the customer.');
            $table->string('phone')->nullable()->comment('The contact phone for the customer.');
            $table->string('phone_alt')->nullable()->comment('A second contact phone for the customer.');

            // Foreign Key
            $table->foreign('tax_type_id')->references('id')->on('tax_type');
            $table->foreign('customer_status_id')->references('id')->on('customer_status');
            $table->foreign('building_id')->references('id')->on('building');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer');
    }
}
