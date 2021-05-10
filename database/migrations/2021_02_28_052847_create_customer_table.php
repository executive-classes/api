<?php

use App\Enums\Billing\CustomerStatusEnum;
use App\Models\Billing\Address;
use App\Models\Billing\CustomerStatus;
use App\Models\Billing\TaxType;
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
            $table->id()
                ->comment('Customer ID.');

            // Timestamps
            $table->timestamps();

            $table->timestamp('inactive_at')
                ->nullable()
                ->comment('Customer inactivate date.');

            $table->timestamp('reactive_at')
                ->nullable()
                ->comment('Customer reactivate date.');


            // Customer Data
            $table->foreignIdFor(CustomerStatus::class, 'customer_status_id')
                ->default(CustomerStatusEnum::ACTIVE)
                ->references('id')
                ->on('customer_status')
                ->comment('Determine the status of the customer.');

            $table->string('name')
                ->comment('Customer name.');

            $table->foreignIdFor(TaxType::class, 'tax_type_id')
                ->references('id')
                ->on('tax_type')
                ->comment('Customer tax type.');

            $table->string('tax_code')
                ->unique()
                ->comment('Customer tax code.');

            $table->foreignIdFor(TaxType::class, 'tax_type_alt_id')
                ->nullable()
                ->references('id')
                ->on('tax_type')
                ->comment('Customer alternative tax type.');

            $table->string('tax_code_alt')
                ->nullable()
                ->unique()
                ->comment('Customer alternative tax code.');

            // Customer contact data
            $table->foreignIdFor(Address::class, 'address_id')
                ->references('id')
                ->on('address')
                ->comment('Determine the address of the customer.');

            $table->string('email')
                ->nullable()
                ->comment('The contact e-mail for the customer.');

            $table->string('phone')
                ->nullable()
                ->comment('The contact phone for the customer.');

            $table->string('phone_alt')
                ->nullable()
                ->comment('A second contact phone for the customer.');

        });

        // Adding columns comments.
        Schema::table('customer', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
                ->comment('Customer creation date.')
                ->change();

            $table->timestamp('updated_at')
                ->comment('Customer last update date.')
                ->change();
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
